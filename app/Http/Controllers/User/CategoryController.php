<?php

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Requests\CategoryRequest;
use App\Models\Product;
use App\Services\ServiceProduct;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use FFI\Exception;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    protected $serviceProduct;

    public function __construct(ServiceProduct $serviceProduct)
    {
        $this->serviceProduct = $serviceProduct;
    }
    /**
     * view user.index
     *
     * @return view
     */
    public function index()
    {
        $categorys = new ProductCategory();
    
        $categorys = $categorys
        ->select(
            'id',
            'name',
            'parent_id')
        ->with('productCategory')
        ->paginate(PAGINATE_USER);
        return view('user.category.index',['categorys'=>$categorys]);
    }
    /**
     * view add category
     *
     * @return Response
     */
    public function create()
    {
        return view('user.category.create');
    }
    /**
     * add user
     *
     * @param CategoryRequest $request
     *
     * @return add new category
     */
    public function store(CategoryRequest $request)
    {
        DB::beginTransaction();
        try{
            $category = new ProductCategory();
            if($request->parent_id == "NULL") $request->parent_id = null;
            
            $category->name = $request->name;
            $category->parent_id = $request->parent_id;
            $category->expired_at = Carbon::now();
            $category->save();
            $message = [
                'type' => 'Create category',
                'content' => 'has been done',
            ];
            DB::commit();
            Alert::success(__('messages.category'), __('messages.success'));
            return redirect()->route('category')->with('message', 'Add user successfully');
  
        } catch (Exception $e) {
            DB::rollBack();
        }
  
    }
    /**
     * view category edit
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id){
        $category = ProductCategory::findOrFail($id);
        return view('user.category.edit',['category'=> $category]);
    }
        
    /**
     * edit category
     *
     * @param CategoryRequest $request
     * @param int $id
     *
     * @return edit category
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = ProductCategory::where('id',$id)
        ->select('id','name','parent_id')
        ->first();
        if($category){
            DB::beginTransaction();
            try{
                if($request->parent_id == "NULL") $request->parent_id = null;
                
                $category->name = $request->name;
                $category->parent_id = $request->parent_id;
                $category->save();
                
    
                DB::commit();
                
            } catch (Exception $e) {
                DB::rollBack();
            }
            Alert::success(__('messages.edit_category'), __('messages.success'));
                return redirect()
                ->route('category')
                ->with( 'Update category successfully');
        }
        
        
    }
     /**
     * delete category
     *
     * @param int  $id
     *
     * @return delete category
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try{

            $data = $this
                    ->serviceProduct
                    ->delete($id,ProductCategory::class);
            
            DB::commit();
            Product::where('catrgory_id',$id)->delete();
            return response()->json();
            
        } catch (Exception $e) {
            DB::rollBack();
        }
        
        
    }

}
