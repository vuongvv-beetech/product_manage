<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\EditProductRequest;
use App\Http\Requests\EditUserRequest;
use App\Services\ServiceProduct;
use Carbon\Carbon;
use PDF;
use Illuminate\Support\Facades\DB;
use FFI\Exception;
use Illuminate\Http\Response;
use RealRashid\SweetAlert\Facades\Alert;
use App\Repositories\RepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\CrudRepository;

class ProductController extends Controller
{
    protected $serviceProduct;

    public function __construct(ServiceProduct $serviceProduct)
    {
        $this->serviceProduct = $serviceProduct;
    }

    // protected $productRepository;

    // public function __construct(CrudRepository $productRepository)
    // {
    //     $this->productRepository = $productRepository;
    // }
    /**
     * view all product
     * 
     * @param Request $request
     *
     * @return view
     */
    public function index(Request $request)
    {
        $nameSearch = $request->name_product;
        
        // $products = $this->productRepository->getAll();
        $products = Product::select(
            'id',
            'sku',  
            'name',
            'stock',
            'avatar',
            'catrgory_id'
        );

        if($request->name_product ){
            $products = $products
                        ->where('name','like',"%$nameSearch%")
                        ->orWhereHas('productCategory', function($query) use ($nameSearch) {
                            $query->where('productcategorys.name','like',"%$nameSearch%");
                        });
            
        }
        if($request->stock){
            $stock = explode(',', $request->stock);
            $products = $products
                        ->where('stock','>',$stock[0])
                        ->where('stock','<=',$stock[1]);
        }
        
        $products = $products->paginate(PAGINATE_USER);
        
       
        return view('user.product.index',['products'=>$products]);
    }
    /**
     * view add product
     *
     * @return Response
     */
    public function create()
    {
        return view('user.product.create');
    }
    /**
     * add user
     *
     * @param ProductRequest $request
     *
     * @return add new product
     */
    public function store(ProductRequest $request)
    {
        DB::beginTransaction();
        try{
            $product = new Product();
            $product->sku = $request->sku;
            $product->name = $request->name;
            $product->stock = $request->stock;
            $product->expired_at = Carbon::now();
            $product->catrgory_id = $request->category_id;

            // save image product
            $this->serviceProduct->uploadImage(
                                    $request,
                                    $product,
                                    'avatar',
                                    '/upload/product',
                                    'public/upload/product/'
                                );

            $product->save();
            DB::commit();
            $message = [
                'type' => 'Create product',
                'content' => 'has been done',
            ];

            Alert::success(__('messages.add_product'), __('messages.success'));
            return redirect()->route('product')->with('message', 'Add user successfully');
            
  
        } catch (Exception $e) {
            DB::rollBack();
        }
        
    }
    /**
     * view product edit
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id){
        $product = Product::findOrFail($id);
        return view('user.product.edit',['product'=> $product]);
    }
    /**
     * edit product
     *
     * @param EditProductRequest $request
     * @param int $id
     *
     * @return edit product
     */
    public function update(EditProductRequest $request, $id)
    {
        $product = Product::select(
            'id',
            'sku',  
            'name',
            'stock',
            'expired_at',
            'catrgory_id'
        )
        ->where('id','=',$id)
        ->first();
        if($product){
            DB::beginTransaction();
            try{
                $product->sku = $request->sku;
                $product->name = $request->name;
                $product->stock = $request->stock;
                $product->expired_at = Carbon::now();    
                $product->catrgory_id = $request->category_id;
    
                //save image product
                $this->serviceProduct->uploadImage(
                                        $request,
                                        $product,
                                        'avatar',
                                        '/upload/product',
                                        'public/upload/product/'
                                    );
    
                $product->save();
                DB::commit();
                
            } catch (Exception $e) {
                DB::rollBack();
            }
            Alert::success(__('messages.edit_product'), __('messages.success'));
            return redirect()->route('product')->with( 'Update product successfully');
        }
        
    }
    /**
     * delete product
     *
     * @param int $id
     *
     * @return delete product
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try{
            $data = $this
                    ->serviceProduct
                    ->delete($id,Product::class);
            DB::commit();
            return response()->json();
        } catch (Exception $e) {
            DB::rollBack();
        }
    }
    /**
     * export file pdf
     *
     * @param $data
     *
     * @return download file pdf
     */
    public function exportPDF()
    {
        $products = Product::select(
            'id',
            'sku',  
            'name',
            'stock',
            'catrgory_id',
            'expired_at'
        );
        $products = $products->with('productCategory')
                            ->get();
        
        $data = [
            'title' => 'Danh sách sản phẩm',
            'date' => date(Carbon::now()),
            'products' => $products
        ];

        $pdf = PDF::loadView('user.product.exportPDF', $data);

        return $pdf->download('product-list.pdf');
    }
    /**
     * export file csv
     *
     * @param $data
     *
     * @return download file csv
     */
    public function exportCSV()
    {
        $fileName = 'tasks.csv';
        $products = DB::table('products')
            ->leftjoin('productcategorys', 'products.catrgory_id', '=', 'productcategorys.id')
            ->select(
                'products.id',
                'products.sku',
                'products.name',
                'products.stock',
                'productcategorys.name as category_name',
                'products.expired_at',
                 )
            ->get();
            $headers = array(
                "Content-Encoding"    => "UTF-8",
                "Content-type"        => "text/csv; charset=UTF-8",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma"              => "no-cache",
                "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                "Expires"             => "0"
            );
     
            $columns = array(
                'Id',
                'SKU', 
                'Name', 
                'Stock', 
                'Category',
                'Expired_at'
            );
             $callback = function() use($products, $columns) {
                ob_start();
                 $file = fopen('php://output', 'w');
                fputcsv($file, $columns);
                 foreach ($products as $task) {
                    fputcsv($file, json_decode(json_encode($task), true));
                 }
     
                 fclose($file);
             };
             return response()->stream($callback,Response::HTTP_OK, $headers);
    }
    /**
     * check sku
     *
     * @param Request $request
     *
     * @return Response
     */
    public function checkSKU(Request $request)
    {
        if($request->sku)
        {
            $product = Product::where("sku",$request->sku)
            ->select('sku')->first();
            if($product)
                return "false";
            else return "true";
        }
    }
}
