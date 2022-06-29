<?php

use App\Http\Controllers\Admin\CategoryProductController;
use Illuminate\Support\Facades\Route;


/**
 * Product x Category
 */
Route::delete('products/{id}/category/{idCategory}/detach', [CategoryProductController::class, 'detachCategoryProduct'])->name('products.category.detach');
Route::post('products/{id}/categories', [CategoryProductController::class, 'attachCategoriesProduct'])->name('products.categories.attach');
Route::any('products/{id}/categories/create', [CategoryProductController::class, 'categoriesAvailable'])->name('products.categories.available');
Route::get('products/{id}/categories', [CategoryProductController::class, 'categories'])->name('products.categories');
Route::get('categories/{id}/products', [CategoryProductController::class, 'products'])->name('categories.products');
