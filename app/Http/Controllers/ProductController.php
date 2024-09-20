<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function products()
    {
        $data=Product::where('status',2)->get();
        return response()->json([
            'message' => 'Get All Products Successfully',
            'data' => $data,
        ], 200);
    }
    public function product($id)
    {
        $data=Product::where('id',$id)->where('status',2)->with('category')->first();
        if ($data){
            return response()->json([
                'message' => 'Get Product Successfully',
                'data' => $data,
            ], 200);
        }else{
            return response()->json([
                'message' => 'No Product found or inactive',
                'errors' => [
                    'id' => 'No Product found or inactive',
                ],
            ], 404);
        }
    }
    public function products_category()
    {
        $data=Product::where('status',2)->with('category')->get();
        return response()->json([
            'message' => 'Get Products With Category Successfully',
            'data' => $data,
        ], 200);

    }
}
