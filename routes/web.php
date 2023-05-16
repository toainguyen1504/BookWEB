<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BookController;

use App\Http\Controllers\SignupController;
// use App\Http\Controllers\Auth\SigninAdminController;
use App\Http\Controllers\Auth\SigninController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//VIEW USER
Route::get('/', [ClientController::class, 'index'])->name('index');

//SigninController
Route::get('signin', [SigninController::class, 'templateSignin'])->name('templateSignin');
Route::post('signin', [SigninController::class, 'signin'])->name('signin');
Route::get('signout', [SigninController::class, 'signout'])->name('signout');

// SignupController
Route::get('signup/index', [SignupController::class, 'index'])->name('signup');
Route::post('signup/store', [SignupController::class, 'store'])->name('signup.store');


Route::middleware('check_signin_user')->group(function () {
    //user login index
    Route::get('user/{id}', [ClientController::class, 'userIndex'])->name('userIndex');
    Route::get('profile/{id}', [ClientController::class, 'profile'])->name('profile');

});

//ADMIN
Route::middleware('check_signin_admin')->group(function () {

    Route::get('admin/dashboard/index', [DashboardController::class, 'index'])->name('admin.dashboard.index');
    //CategoryController
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::prefix('category')->name('category.')->controller(CategoryController::class)->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::post('update/{id}', 'update')->name('update');
            Route::get('delete/{id}', 'delete')->name('delete');
        });
    });

    //BookController
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::prefix('book')->name('book.')->controller(BookController::class)->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::post('update/{id}', 'update')->name('update');
            Route::get('delete/{id}', 'delete')->name('delete');
        });
    });

    //UserController
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::prefix('user')->name('user.')->controller(UserController::class)->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');

            Route::get('edit/{id}', 'edit')->name('edit');
            Route::post('update/{id}', 'update')->name('update');
            Route::get('delete/{id}', 'delete')->name('delete');
            Route::get('lock/{id}', 'lockUser')->name('lock');
            Route::get('unlock/{id}', 'unlockUser')->name('unlock');
        });
    });

});
