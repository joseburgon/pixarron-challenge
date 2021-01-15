<?php

namespace App\Http\Controllers\api\v1\product;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {

        return ProductCollection::make(Product::paginate());

    }


    public function show(Product $product)
    {

        return ProductResource::make($product);

    }
}
