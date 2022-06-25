<?php

use App\Http\Controllers\Admin\CategoryProductController;
use Illuminate\Support\Facades\Route;


Route::any('categories/{id}/products/create', [CategoryProductController::class, 'categoriesAvailable'])->name('categories.products.available');
Route::get('products/{id}/category', [CategoryProductController::class, 'profiles'])->name('products.categories');
