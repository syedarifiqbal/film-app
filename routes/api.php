<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return [
        'user' => $request->user()
    ];
});

Route::get('/films', [App\Http\Controllers\FilmController::class, 'index'])->name('films.index');
Route::get('/films/{film}/comments', [App\Http\Controllers\CommentController::class, 'index'])->name('comments.index');

Route::post('/films', [App\Http\Controllers\FilmController::class, 'store'])->name('films.store');
Route::put('/films/{film}', [App\Http\Controllers\FilmController::class, 'update'])->name('films.update');
Route::get('/films/{film:slug}', [App\Http\Controllers\FilmController::class, 'show'])->name('films.update');
Route::post('/films/{film}/comments', [App\Http\Controllers\CommentController::class, 'store'])->name('comments.store');
