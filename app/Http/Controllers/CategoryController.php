<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categories()
    {
        $data=Category::where('status',2)->get();
        return response()->json([
            'message' => 'Get All Categories Successfully',
            'data' => $data,
        ], 200);
    }

    public function category($id)
    {
        $data=Category::where('id',$id)->where('status',2)->with('products')->first();
        if ($data){
            return response()->json([
                'message' => 'Get Category Successfully',
                'data' => $data,
            ], 200);
        }else{
            return response()->json([
                'message' => 'No Category found or inactive',
                'errors' => [
                    'id' => 'No Category found or inactive',
                ],
            ], 404);
        }

    }
    public function category_products(){
        $data=Category::where('status',2)->with('products')->get();
        return response()->json([
            'message' => 'Get Category With Products Successfully',
            'data' => $data,
        ], 200);
    }
}
