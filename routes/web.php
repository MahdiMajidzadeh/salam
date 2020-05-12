<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'login')->name('login');
Route::post('/', 'AccountsController@loginSubmit');

Route::group(['middleware' => 'auth'], function(){
    Route::get('/dashboard', 'PagesController@dashboard');
});