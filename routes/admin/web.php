<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\WelcomeController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\EducBitController;
use App\Http\Controllers\Admin\PlaylistCategoryController;
use App\Http\Controllers\Admin\PostCategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\SeriesController;
use App\Http\Controllers\Admin\TopicController;
use App\Models\Post;
use App\Models\PostCategory;
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
    Route::prefix('/teachers')->name('teachers.')->controller(TeacherController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/{teacher:username}/edit', 'edit')->name('edit');
        Route::put('/{teacher}', 'update')->name('update');
        Route::delete('/{teacher}', 'destroy')->name('destroy');
        Route::post('/delete-selected', 'destroySelected')->name('destroy-selected');
        Route::post('/{teacher}/reject', 'rejectRequest')->name('rejectRequest');
        Route::post('/{teacher}/activation', 'activation')->name('activation');
    });

    // group for admins
    Route::prefix('admins')->name('admins.')->controller(AdminController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/{admin:username}/edit', 'edit')->name('edit');
        Route::put('/{admin}/update', 'update')->name('update');
        Route::post('role/{role}/permissions', 'permissions')->name('roles.permissions');
        Route::delete('/{admin}', 'destroy')->name('destroy');
        Route::post('/delete-selected', 'destroySelected')->name('destroy-selected');
        Route::post('/{admin}/activation', 'activation')->name('activation');
    });
});

// group for question
Route::prefix('/questions')->name('questions.')->controller(QuestionController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('{question}/edit', 'edit')->name('edit');
    Route::put('/{question}/update', 'update')->name('update');
    Route::delete('/{question}', 'destroy')->name('destroy');
    Route::post('/delete-selected', 'destroySelected')->name('destroy-selected');
    Route::post('/{question}/read', 'read')->name('read');
    Route::post('/{question}/replay', 'replay')->name('replay');
});

// group for posts Categories
Route::prefix('/posts-categories')->name('posts-categories.')->controller(PostCategoryController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/{postCategory:name}/edit', 'edit')->name('edit');
    Route::put('/{postCategory:name}/update', 'update')->name('update');
    Route::delete('/{postCategory}', 'destroy')->name('destroy');
    Route::post('/delete-selected', 'destroySelected')->name('destroy-selected');
    Route::post('/{postCategory}/activation', 'activation')->name('activation');
});


// group for posts
Route::prefix('/posts')->name('posts.')->controller(PostController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/{post:title}/edit', 'edit')->name('edit');
    Route::put('/{post:title}/update', 'update')->name('update');
    Route::delete('/{post}', 'destroy')->name('destroy');
    Route::post('/{post}/activation', 'activation')->name('activation');
});

// group for comments
Route::prefix('/comments')->name('comments.')->controller(CommentController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::delete('/{comment}', 'destroy')->name('destroy');
    Route::get('/{comment}/show', 'show')->name('show');
    Route::post('/delete-selected', 'destroySelected')->name('destroy-selected');
});

// group for playlist category
Route::prefix('/playlist-categories')->name('playlist-categories.')->controller(PlaylistCategoryController::class)->group(function () {
    Route::get('/', 'index')->name('index');
});

// group for educ bits
Route::prefix('/educ-bits')->name('educ-bits.')->controller(EducBitController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{id}/show', 'show')->name('show');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/{bit}/edit', 'edit')->name('edit');
    Route::put('/{bit}/update', 'update')->name('update');
    Route::get('/empty-episode', 'createEmptyEpisode')->name('createEmptyEpisode');
    Route::post('/upload-episode', 'uploadEpisode')->name('upload-episode');
    Route::post('/{bit}/activation', 'activation')->name('activation');
    Route::delete('/{bit}', 'destroy')->name('destroy');
});

// group for Topics
Route::prefix('/topics')->name('topics.')->controller(TopicController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/{topic:name}/edit', 'edit')->name('edit');
    Route::put('/{topic:name}/update', 'update')->name('update');
    Route::post('/{topic}/activation', 'activation')->name('activation');
    Route::delete('/{topic}', 'destroy')->name('destroy');
});

// group for series
Route::prefix('/series')->name('series.')->controller(SeriesController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{series}/show', 'show')->name('show');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::post('/{series}/activation', 'activation')->name('activation');
    Route::post('/{section:id}/store/episode', 'storeEpisode')->name('storeEpisode');
    Route::delete('/{series}', 'destroy')->name('destroy');
});

// group for section
Route::prefix('/sections')->name('sections.')->controller(SectionController::class)->group(function () {
    Route::get('series/{series}/show', 'show')->name('show');
    Route::post('/store', 'store')->name('store');
});

// setting route
Route::middleware('role:super_admin')->prefix('/settings')->name('settings.')->controller(SettingController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/store', 'store')->name('store');
});
