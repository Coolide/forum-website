<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::get('/user/{username}', [UserController::class, 'index'])->name('view.user');

Route::get('post/create', [PostController::class, 'create'])->middleware(['auth', 'verified'])->name('post.create');
Route::post('post', [PostController::class, 'store'])->middleware(['auth', 'verified'])->name('post.store');
Route::get('/post/{slug}', [PostController::class, 'index'])->name('show.post');

Route::get('/communities', [CommunityController::class, 'index'])->name('communities');
Route::get('/community/create', [CommunityController::class, 'create'])->middleware(['auth', 'verified'])->name('community.create');
Route::post('community', [CommunityController::class, 'store'])->middleware(['auth', 'verified'])->name('community.store');
Route::get('/community/{slug}', [CommunityController::class, 'show'])->name('show.community');

Route::post('/comment', [CommentController::class, 'store'])->middleware(['auth', 'verified'])->name('comment.store');





require __DIR__.'/auth.php';
