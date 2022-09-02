<?php

use App\Http\Controllers\Api\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'product'], function () {
    Route::get('find-all', [ProductsController::class, 'findAll'])->name('api.product.find-all');
    Route::get('find', [ProductsController::class, 'find'])->name('api.product.find');
    Route::post('store', [ProductsController::class, 'store'])->name('api.product.store');
    Route::match(['put', 'path'],'update', [ProductsController::class, 'update'])->name('api.product.update');
    Route::delete('delete/{id}', [ProductsController::class, 'destroy'])->name('api.product.delete');
});
