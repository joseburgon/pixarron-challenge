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

        if (auth()->user()->hasRole('admin')) {

            return ProductCollection::make(Product::paginate());

        } else {

            return response([
                'message' => 'You don\'t have permission to access this information.'
            ]);

        }

    }


    public function show(Product $product)
    {

        return ProductResource::make($product);

    }
}
