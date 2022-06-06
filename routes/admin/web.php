<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\admin\WelcomeController;
use App\Http\Controllers\CategoryBlogController;
use Illuminate\Support\Facades\Route;

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

// welcome controller route
Route::get('/', WelcomeController::class)->name('welcome');



// Categories blogs route
Route::prefix('/categories-blogs')->name('categories.blogs.')->controller(CategoryBlogController::class)->group(function () {

    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
});


// Role controller route
Route::prefix('/roles')->name('roles.')->controller(RoleController::class)->group(function () {

    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::delete('/{role}', 'destroy')->name('destroy');
});
