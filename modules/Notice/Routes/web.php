<?php

use Illuminate\Support\Facades\Route;
use Modules\Notice\Http\Controllers as C;

Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function() {
    Route::group(['prefix' => 'notices'], function() {
        Route::get('/', [C\AdminController::class, 'index']);
        Route::get('/create', [C\AdminController::class, 'create']);
        Route::post('/create', [C\AdminController::class, 'store']);
    });
});

Route::get('/notices/{id}', [C\NoticeController::class, 'show']);
