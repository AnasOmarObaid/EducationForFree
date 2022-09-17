<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\EducBitController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\UserRequestController;
use App\Http\Controllers\WelcomeController;
use App\Models\EducBit;
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


// route for welcome page
Route::get('/', WelcomeController::class)->name('welcome');

// route to user request controller
Route::post('/request-teacher', [UserRequestController::class, 'requestTeacher'])->name('request.teacher');

// route for pages
Route::name('pages.')->controller(PageController::class)->group(function () {
    Route::get('/about-us', 'about')->name('about');
    Route::get('/support', 'support')->name('support');
    Route::get('/faq', 'faq')->name('faq');
    Route::get('/privacy', 'privacy')->name('privacy');
    Route::get('/term', 'term')->name('term');
    Route::get('/teach', 'teach')->name('teach');
    Route::prefix('/topics')->name('topics.')->controller(TopicController::class)->group(function () {
        Route::get('/', 'all')->name('all');
        Route::get('/framework', 'framework')->name('framework');
        Route::get('/testing', 'testing')->name('testing');
        Route::get('/languages', 'languages')->name('languages');
        Route::get('/tooling', 'tooling')->name('tooling');
        Route::get('/techniques', 'techniques')->name('techniques');
    });

    // post route
    Route::prefix('/posts')->name('posts.')->controller(PostController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{post:title}/show', 'show')->name('show');
    });

    // bit route
    Route::prefix('/educ-bits')->name('bits.')->controller(EducBitController::class)->group(function(){
        Route::get('/', 'index')->name('index');
    });

    // series route
    Route::prefix('/series')->name('series.')->controller(SeriesController::class)->group(function(){
        Route::get('/', 'index')->name('index');
        Route::get('/{series}', 'info')->name('info');
        Route::get('/{series}/{episode}', 'show')->name('show');
    });

    Route::get('/{user:username}/episodes/{bit}', [EducBitController::class, 'show'])->name('users.episodes');
});


// route for comment
Route::prefix('/comments')->name('comments.')->controller(CommentController::class)->group(function () {
    Route::post('/{post}/store', 'storePostComment')->name('posts');
    Route::post('/episode/{episode}/store', 'storeEpisodeComment')->name('episodes');
    Route::delete('delete/{comment}', 'destroyComment')->name('posts.destroy');
    Route::post('/{comment}/update', 'updateComment')->name('posts.update');
    Route::post('/{comment}/like', 'likeComment')->name('posts.like');
    Route::post('/{comment}/replay', 'commentReplay')->name('replay');
});


// route for support
Route::post('/support', [SupportController::class, 'store'])->name('support.store');


// route for dashboard
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
