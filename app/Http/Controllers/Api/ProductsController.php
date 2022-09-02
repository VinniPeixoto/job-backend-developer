<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Services\Products\DeleteProductsService;
use App\Services\Products\GetProductsService;
use App\Services\Products\StoreProductsService;
use App\Services\Products\UpdateProductsService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;

class ProductsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProductRequest $request
     * @return ProductResource|\Illuminate\Http\JsonResponse
     */
    public function store(StoreProductRequest $request, StoreProductsService $storeService)
    {
        try {
            $request->validated();

            $product = $storeService->run($request->all());

            return new ProductResource($product);
        }catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param GetProductsService $getProductsService
     * @return ProductCollection|ProductResource
     */
    public function find(Request $request, GetProductsService $getProductsService)
    {
        $products = $getProductsService->run($request->all());
        if (Arr::get($request, 'id')) {
            return new ProductResource($products);
        }
        return new ProductCollection($products);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductRequest $request
     * @return ProductResource|\Illuminate\Http\JsonResponse|Response
     */
    public function update(UpdateProductRequest $request, UpdateProductsService $updateService)
    {
        try {
            $request->validated();

            $product = $updateService->run($request->all());

            return new ProductResource($product);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id, DeleteProductsService $deleteProductsService)
    {
        $deleted = $deleteProductsService->run($id);

        return response()->json(['message' => $deleted['message']], $deleted['status']);
    }
}
