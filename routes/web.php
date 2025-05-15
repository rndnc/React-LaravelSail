<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductListController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return view('index');
});
Route::get('/productList', [ProductListController::class]);
Route::get('/detail/{id}', function () {
    return view('productDetail');
});
Route::get('/regist', function () {
    return view('productRegist');
});
Route::get('/update/{id}', function () {
    return view('productUpdate');
});
