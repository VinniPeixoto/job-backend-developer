<?php

namespace App\Services\Products;

use App\Models\Product;
use Illuminate\Support\Arr;

class StoreProductsService
{
    public function run($request)
    {

        Arr::set($request, 'image_url', Arr::get($request, 'image'));

        return Product::create($request);
    }
}
