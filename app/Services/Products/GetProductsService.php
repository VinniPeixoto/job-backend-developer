<?php

namespace App\Services\Products;

use App\Models\Product;
use Illuminate\Support\Arr;

class GetProductsService
{
    public function run($request)
    {
        if (Arr::get($request, 'id')) {
            return Product::find(Arr::get($request, 'id'));
        } else {
            return Product::filterNameOrCategory(Arr::get($request, 'name'))
                ->filterCategory(Arr::get($request, 'category'))
                ->filterImage(Arr::get($request, 'image'))
                ->get();
        }
    }
}
