<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
  //  return view('welcome');
//});

Route::get('/', 
        [App\Http\Controllers\PublicPagesController::class, 
        'get_index'])
        ->name('public.get.index');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


// start get auth routes 
Route::get('auth/login_email', 
        [App\Http\Controllers\auth\CustAuthGetController::class, 
        'get_login_email'])
        ->name('auth.get.login-email');



Route::get('auth/register_email', 
        [App\Http\Controllers\auth\CustAuthGetController::class, 
        'get_register_email'])
        ->name('auth.get.register-email');

// end get auth routes 


// start post auth routes 
Route::post('auth/login_email', 
        [App\Http\Controllers\auth\CustAuthPostController::class, 
        'post_login_email'])
        ->name('auth.post.login-email');


Route::post('auth/register_email', 
        [App\Http\Controllers\auth\CustAuthPostController::class, 
        'post_register_email'])
        ->name('auth.post.register-email');


// end post auth routes



Route::get('auth/logout', 
        [App\Http\Controllers\auth\CustAuthGetController::class, 
        'get_logout'])
        ->name('auth.get.logout');

// start blog routes

Route::get('blog/show_blog', 
        [App\Http\Controllers\BlogController::class, 
        'get_show_blog'])
        ->name('blog.get.show_blog');

// end blog routes

