<?php

use App\Http\Controllers as C;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard');
Route::view('/login', 'login')->name('login');
Route::post('/login', [C\AccountsController::class, 'loginSubmit']);
Route::get('/logout', [C\AccountsController::class, 'logout']);

Route::group(['middleware' => 'auth'], function() {
    Route::get('/dashboard', [C\PagesController::class, 'dashboard']);
    Route::view('/change-log', 'pages.change_log');

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

    Route::group(['prefix' => 'contacts'], function() {
        Route::get('/', [C\ContactsController::class, 'index']);
        Route::get('/chapters', [C\ContactsController::class, 'chapters']);
        Route::get('/teams', [C\ContactsController::class, 'teams']);
    });

    Route::get('/notices/{id}', [C\PagesController::class, 'singleNotice']);
});

Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function() {
    Route::get('/', [C\PagesController::class, 'adminDashboard']);
    Route::get('/users-bill', [C\Admin\BillController::class, 'usersBill']);
    Route::get('/users-bill-export', [C\Admin\BillController::class, 'exportUsersBill']);
    Route::get('/restaurant/add', [C\Admin\FoodController::class, 'addRestaurant']);
    Route::get('/restaurants-bill', [C\Admin\BillController::class, 'restaurantsBill']);
    Route::post('/restaurant/add', [C\Admin\FoodController::class, 'addRestaurantSubmit']);
    Route::get('/restaurants', [C\Admin\FoodController::class, 'restaurantsList']);
    Route::get('/booking/add', [C\Admin\FoodBookingController::class, 'add']);
    Route::post('/booking/add', [C\Admin\FoodBookingController::class, 'addSubmit']);
    Route::get('/booking/day-list', [C\Admin\FoodBookingController::class, 'dayList']);

    Route::group(['prefix' => 'users'], function() {
        Route::get('/', [C\Admin\UserController::class, 'usersList']);
        Route::get('/add', [C\Admin\UserController::class, 'add']);
        Route::post('/add', [C\Admin\UserController::class, 'addSubmit']);
        Route::get('/{id}', [C\Admin\UserController::class, 'edit']);
        Route::post('/edit', [C\Admin\UserController::class, 'editSubmit']);
        Route::post('/edit/avatar', [C\Admin\UserController::class, 'avatarSubmit']);
    });

    Route::group(['prefix' => 'otagh'], function() {
        Route::get('/list', [C\Admin\OtaghController::class, 'check']);
    });

    Route::group(['prefix' => 'foods'], function() {
        Route::get('/', [C\Admin\FoodController::class, 'foodsList']);
        Route::get('/add', [C\Admin\FoodController::class, 'addFood']);
        Route::post('/add', [C\Admin\FoodController::class, 'addFoodSubmit']);
        Route::get('/{id}', [C\Admin\FoodController::class, 'editFood']);
        Route::post('/edit', [C\Admin\FoodController::class, 'editFoodSubmit']);
    });

    Route::group(['prefix' => 'acl'], function() {
        Route::get('/', [C\Admin\AdminController::class, 'adminList']);
        Route::get('/{id}', [C\Admin\AdminController::class, 'adminPermissions']);
        Route::post('/', [C\Admin\AdminController::class, 'adminPermissionsSubmit']);
    });

    Route::group(['prefix' => 'notices'], function() {
        Route::get('/', [C\Admin\NoticeController::class, 'all']);
        Route::get('/create', [C\Admin\NoticeController::class, 'add']);
        Route::post('/create', [C\Admin\NoticeController::class, 'addSubmit']);
    });

    Route::group(['prefix' => 'ajax'], function() {
        Route::get('users/list', [C\Ajax\UserController::class, 'userList']);
        Route::get('tahdig/received/{id}', [C\Ajax\TagDigController::class, 'receivedReservation']);
    });
});
