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


// start posts routes

Route::get('posts/choose_post', 
        [App\Http\Controllers\PostController::class, 
        'get_choose_post'])
        ->name('posts.get.choose_post');

Route::post('posts/choose_post', 
        [App\Http\Controllers\PostController::class, 
        'post_choose_post'])
        ->name('posts.post.choose_post');

Route::get('posts/create_post', 
        [App\Http\Controllers\PostController::class, 
        'get_create_post'])
        ->name('posts.get.create_post');

Route::post('posts/create_post', 
        [App\Http\Controllers\PostController::class, 
        'post_create_post'])
        ->name('posts.post.create_post');

Route::get('posts/delete_post', 
        [App\Http\Controllers\PostController::class, 
        'get_delete_post'])
        ->name('posts.get.delete_post');

Route::post('posts/delete_post', 
        [App\Http\Controllers\PostController::class, 
        'post_delete_post'])
        ->name('posts.post.delete_post');


Route::get('posts/view_posts', 
        [App\Http\Controllers\PostController::class, 
        'get_view_posts'])
        ->name('posts.get.view_posts');
       

Route::get('posts/update_post', 
        [App\Http\Controllers\PostController::class, 
        'get_update_post'])
        ->name('posts.get.update_post');

Route::post('posts/update_post', 
        [App\Http\Controllers\PostController::class, 
        'post_update_post'])
        ->name('posts.post.update_post');

// end posts routes


// start comments routes

Route::get('comments/choose_comment', 
        [App\Http\Controllers\CommentsController::class, 
        'get_choose_comment'])
        ->name('comments.get.choose_comment');

Route::post('comments/choose_comment', 
        [App\Http\Controllers\CommentsController::class, 
        'post_choose_comment'])
        ->name('comments.post.choose_comment');

Route::get('comments/create_comment/{post_id}', 
        [App\Http\Controllers\CommentsController::class, 
        'get_create_comment'])
        ->name('comments.get.create_comment');


Route::post('comments/create_comment', 
        [App\Http\Controllers\CommentsController::class, 
        'post_create_comment'])
        ->name('comments.post.create_comment');

Route::get('comments/delete_comment', 
        [App\Http\Controllers\CommentsController::class, 
        'get_delete_comment'])
        ->name('comments.get.delete_comment');

Route::post('comments/delete_comment', 
        [App\Http\Controllers\CommentsController::class, 
        'post_delete_comment'])
        ->name('comments.post.delete_comment');

Route::get('comments/view_comments', 
        [App\Http\Controllers\CommentsController::class, 
        'get_view_comments'])
        ->name('comments.get.view_comments');
       

Route::get('comments/update_comment', 
        [App\Http\Controllers\CommentsController::class, 
        'get_update_comment'])
        ->name('comments.get.update_comment');

Route::post('comments/update_comment', 
        [App\Http\Controllers\CommentsController::class, 
        'post_update_comment'])
        ->name('comments.post.update_comment');

// end comments routes

