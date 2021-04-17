<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Response;

class ApiController extends Controller
{
    /**
     * get all product
     * 
     * 
     *
     * @return Response
     */
    public function allProduct()
    {
        $products = Product::select(
            'id',
            'sku',  
            'name',
            'stock',
            'avatar',
            'catrgory_id'
        );
        
        $products = $products->paginate(PAGINATE_USER);
        return response()->json(
            [
                'status'=> Response::HTTP_OK,
                'msg' => "Message",
                'data' => $products
            ],
        );
    }
    /**
     * get product by id
     * 
     * @param int $id
     *
     * @return Response
     */
    public function detailProduct($id)
    {
        $product = Product::select(
            'id',
            'sku',  
            'name',
            'stock',
            'avatar',
            'catrgory_id'
        )
        ->where('id','=',$id)
        ->first();
        
        return response()->json(
            [
                'status'=> Response::HTTP_OK,
                'msg' => "Message",
                'data' => $product
            ],
        );
    }
}
