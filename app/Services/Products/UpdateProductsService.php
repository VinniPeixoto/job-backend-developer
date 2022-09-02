<?php

namespace App\Services\Products;

use App\Models\Product;
use Illuminate\Support\Arr;

class UpdateProductsService
{
    public function run($request)
    {
        Arr::set($request, 'image_url', Arr::get($request, 'image'));

        $product = Product::where('name', Arr::get($request, 'name'))->first();

        $product->save($request);

        return $product;
    }
}
