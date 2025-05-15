<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::post('/products', [ProductController::class, 'index']);
Route::post('/products/search', [ProductController::class, 'search']);
Route::post('/products/detail/{id}', [ProductController::class, 'show']);
Route::post('/products/getCompany', [ProductController::class, 'getCompany']);
Route::post('/products/registProduct', [ProductController::class, 'create']);
Route::post('/products/updateProduct/{id}', [ProductController::class, 'updateProduct']);
Route::post('/products/update/{id}', [ProductController::class, 'update']);
Route::post('/products/delete/{id}', [ProductController::class, 'delete']);

// デバッグ用のルート
Route::get('/debug', function () {
    return response()->json(['message' => 'API routes are loaded correctly']);
});


// Route::get('/hoge', function (Request $request) {
//     return response()->json(
//         [
//             'hoge' => 'Hello from Laravel'
//         ]
//     );
// });