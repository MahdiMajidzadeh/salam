<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'login');
Route::post('/', 'AccountsController@loginSubmit');