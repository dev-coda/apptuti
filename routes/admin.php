<?php

use App\Http\Controllers\Admin\BonificationController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HolidayController;
use App\Http\Controllers\Admin\LabelController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductCombinationsController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TaxController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VariationController;
use App\Http\Controllers\Admin\VariationItemController;
use App\Http\Controllers\Admin\VendorController;

Route::middleware(['auth', 'role:admin'])->group(function () {


    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    // Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
    Route::post('/products/{product}/images', [ProductController::class, 'images'])->name('products.images');
    Route::delete('/products/{product}/images/{image}', [ProductController::class, 'images_delete'])->name('products.images_delete');

    Route::delete('/products/{product}/add_combined', [ProductController::class, 'add_combined'])->name('products.add_combined');
    Route::delete('/products/{product}/sync_combined', [ProductController::class, 'sync_combined'])->name('products.sync_combined');

    Route::get('/products/{product}/combinations{combination}', [ProductCombinationsController::class, 'remove_combination'])->name('products.remove_combination');

    Route::resource('users', UserController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('taxes', TaxController::class);
    Route::resource('holidays', HolidayController::class);
    Route::resource('products', ProductController::class);
    Route::resource('products.combinations', ProductCombinationsController::class)->only([ 'store', 'update']);
    Route::resource('categories', CategoryController::class);
    Route::resource('labels', LabelController::class);
    Route::resource('vendors', VendorController::class);
    Route::resource('bonifications', BonificationController::class);

    Route::resource('variations', VariationController::class);
    Route::resource('variations.items', VariationItemController::class);


    Route::resource('orders', OrderController::class);




    Route::get('/profile', [VendorController::class, 'index'])->name('profile.update');

});

