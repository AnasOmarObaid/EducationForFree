<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\WelcomeController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TeacherController;
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


// Roles controller route
Route::prefix('/roles')->name('roles.')->controller(RoleController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/{role:name}/edit', 'edit')->name('edit');
    Route::put('/{role}', 'update')->name('update');
    Route::delete('/{role}', 'destroy')->name('destroy');
    Route::post('/delete-selected', 'destroySelected')->name('destroy-selected');
});

// Users Controller routes
Route::prefix('/users')->name('users.')->group(function () {

    // group for students
    Route::prefix('/students')->name('students.')->controller(StudentController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('{student:username}/edit', 'edit')->name('edit');
        Route::put('/{student}', 'update')->name('update');
        Route::delete('/{student}', 'destroy')->name('destroy');
        Route::post('/delete-selected', 'destroySelected')->name('destroy-selected');
        Route::post('/{student}/activation', 'activation')->name('activation');
        Route::post('/{student}/accept-control', 'acceptControl')->name('accept-control');
    });

    // group for teachers
    Route::prefix('/teachers')->name('teachers.')->controller(TeacherController::class)->group(function (){
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/{teacher:username}/edit', 'edit')->name('edit');
        Route::put('/{teacher}', 'update')->name('update');
        Route::delete('/{teacher}', 'destroy')->name('destroy');
        Route::post('/delete-selected', 'destroySelected')->name('destroy-selected');
    });
});

// setting route
Route::middleware('role:super_admin')->prefix('/settings')->name('settings.')->controller(SettingController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/store', 'store')->name('store');
});
