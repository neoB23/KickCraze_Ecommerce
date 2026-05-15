<?php

use App\Http\Controllers\Api\ShoeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('shoes')->group(function () {
    Route::get('/',              [ShoeController::class, 'getAll']);
    Route::get('/brands',        [ShoeController::class, 'brands']);
    Route::get('/sizes',         [ShoeController::class, 'sizes']);
    Route::get('/subcategories', [ShoeController::class, 'subcategories']);

    Route::get('/men',   fn (Request $r) => app(ShoeController::class)->getAll($r->merge(['gender' => 'Men'])));
    Route::get('/women', fn (Request $r) => app(ShoeController::class)->getAll($r->merge(['gender' => 'Women'])));
    Route::get('/kids',  fn (Request $r) => app(ShoeController::class)->getAll($r->merge(['gender' => 'Kids'])));

    Route::get('/{id}',       [ShoeController::class, 'show'])->whereNumber('id');
    Route::get('/{id}/image', [ShoeController::class, 'image'])->whereNumber('id');
});
