<?php

use App\Http\Controllers as C;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard');
Route::view('/login', 'pages.login')->name('login');
Route::post('/login', [C\AccountsController::class, 'loginSubmit']);
Route::get('/logout', [C\AccountsController::class, 'logout']);

Route::group(['middleware' => 'auth'], function() {
    Route::get('/dashboard', [C\PagesController::class, 'dashboard']);

    Route::group(['prefix' => 'setting'], function() {
        Route::get('/',[C\SettingController::class, 'user']);
        Route::post('/',[C\SettingController::class, 'userSubmit']);
        Route::get('/tahdig',[C\SettingController::class, 'tahdig']);
        Route::post('/tahdig',[C\SettingController::class, 'tahdigSubmit']);
        Route::get('/password-reset', [C\SettingController::class, 'passwordReset']);
        Route::post('/password-reset', [C\SettingController::class, 'passwordResetSubmit']);
    });

    Route::group(['prefix' => 'tahdig'], function() {
        Route::redirect('/', 'dashboard');
        Route::get('/reserve', [C\TahDigController::class, 'foodList']);
        Route::post('/reserve', [C\TahDigController::class, 'foodListSubmit']);
        Route::get('/reserve/delete/{reservation}', [C\TahDigController::class, 'deleteReservation']);
        Route::get('/history', [C\TahDigController::class, 'history']);
    });

    Route::group(['prefix' => 'otagh'], function() {
        Route::get('/reserve', [C\OtaghController::class, 'reserve']);
        Route::post('/reserve', [C\OtaghController::class, 'reserveSubmit']);
    });

    Route::group(['prefix' => 'sarnakh'], function() {
        Route::get('/', [C\SarnakhController::class, 'index']);
    });

    Route::group(['prefix' => 'rofagha'], function() {
        Route::get('/', [C\RofaghaController::class, 'index']);
        Route::get('/chapters', [C\RofaghaController::class, 'chapters']);
        Route::get('/teams', [C\RofaghaController::class, 'teams']);
    });

    Route::get('/notices/{id}', [C\PagesController::class, 'singleNotice']);
});

