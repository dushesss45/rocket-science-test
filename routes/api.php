<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductOptionController;
use Illuminate\Support\Facades\Route;

Route::get('/options', [ProductOptionController::class, 'index']);
Route::get('/products', [ProductController::class, 'index']);
