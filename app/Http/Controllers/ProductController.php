<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductDetailsResource;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $page = ( request()->get( 'page' ) ) ? request()->get( 'page' ) : 1;
        $products = Product::orderBy('id', 'desc')->paginate( 10 );
        return ProductResource::collection($products);
    }

    public function show($id)
    {
        $product = Product::find($id);
        if ($product){
            return new ProductDetailsResource($product);
        }
        return response()->json(['error' => 'No product found.'], 422);
    }

}
