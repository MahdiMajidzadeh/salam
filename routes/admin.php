<?php

use App\Http\Controllers as C;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function() {
    Route::get('/', [C\Admin\AdminController::class, 'index']);
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
        Route::post('/edit/deactivate', [C\Admin\UserController::class, 'deactivateSubmit']);
    });

    Route::group(['prefix' => 'otagh'], function() {
        Route::get('/list', [C\Admin\OtaghController::class, 'check']);
        Route::get('/delete/{id}', [C\Admin\OtaghController::class, 'deleteSubmit']);
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

    Route::group(['prefix' => 'shelves'], function() {
        Route::get('/', [C\Admin\LibraryController::class, 'all']);
        Route::get('/create', [C\Admin\LibraryController::class, 'add']);
    });

    Route::group(['prefix' => 'welcome/notes'], function() {
        Route::get('/', [C\Admin\WelcomeController::class, 'noteAll']);
        Route::get('/create', [C\Admin\WelcomeController::class, 'noteAdd']);
        Route::post('/create', [C\Admin\WelcomeController::class, 'noteAddSubmit']);
        Route::get('/{id}/edit', [C\Admin\WelcomeController::class, 'noteEdit']);
        Route::post('/edit', [C\Admin\WelcomeController::class, 'noteEditSubmit']);
        Route::get('/{id}/delete', [C\Admin\WelcomeController::class, 'noteDeleteSubmit']);
    });

    Route::group(['prefix' => 'ajax'], function() {
        Route::get('users/list', [C\Ajax\UserController::class, 'userList']);
        Route::get('tahdig/received/{id}', [C\Ajax\TagDigController::class, 'receivedReservation']);
    });
});
