<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommunityController;

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
    return view('welcome');
});

Route::get('/communities', [CommunityController::class, 'index'])->middleware(['auth', 'verified'])->name('communities');
Route::get('/community/create', [CommunityController::class, 'create'])->middleware(['auth', 'verified'])->name('community.create');
Route::post('community', [CommunityController::class, 'store'])->middleware(['auth', 'verified'])->name('community.store');




require __DIR__.'/auth.php';
