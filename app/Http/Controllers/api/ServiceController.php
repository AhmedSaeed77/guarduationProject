<?php

namespace App\Http\Controllers\api;
use App\Http\Resources\ServiceResource;
use App\Models\Product;
use App\Models\Category;
use App\Models\Region;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function show()
    {
         $products=Product::get();
         $products = ServiceResource::collection($products);

         return response()->json([
            'status' => 201,
            'data'   => $products,
        ], 201);
    }

    public function allCategory()
    {
        $cats = Category::all();
        foreach($cats as $cat)
        {
            $cat->photo = url('images/category/'.$cat->photo);
        }
        return response()->json(['status' => 201,'data' => $cats], 201);
    }

    public function allProductForCat($id)
    {
        $products = Product::where('category_id',$id)->get();
        foreach($products as $product)
        {
            $product->photo = url('images/products/'.$product->photo);
        }
        return response()->json(['status' => 201,'data' => $products], 201);
    }

    public function search(Request $request)
    {
        $product = Product::where('name',$request->name)->first();
        $product->photo = url('images/products/'.$product);
        return response()->json(['status' => 201,'data' => $product], 201); 
    }

    public function filter($govrn_id)
    {
        $products = Product::where('govern_id',$govrn_id)->get();
        return response()->json(['success' => true,'products' => $products], 200); 
    }

    public function filtergovernmentRegion($govrn_id,$region_id)
    {
        $products = Product::where('govern_id',$govrn_id)->where('region_id',$region_id)->get();
        return response()->json(['success' => true,'products' => $products], 200); 
    }
    
}
