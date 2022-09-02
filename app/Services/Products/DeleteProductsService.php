<?php

namespace App\Services\Products;

use App\Models\Product;

class DeleteProductsService
{
    public function run($id)
    {
        try {
            $product = Product::find($id);
            $product->delete();

            return [
                'status' => 200,
                'message' => 'Product deleted'
            ];
        }catch (\Exception $exception) {
            return [
                'status' => 400,
                'message' => $exception->getMessage()
            ];
        }
    }
}
