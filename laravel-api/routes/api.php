<?php

use App\Http\Controllers\LivroController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LivroUserController;

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


// php artisan route:list      
// Route::resource('livros', LivroController::class);

// Public Routes

// Auth Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Livros 
Route::get('/livros', [LivroController::class, 'index']);
Route::get('/livros/{id}', [LivroController::class, 'show']);
Route::get('livros/search/{titulo}', [LivroController::class, 'search']);

// Livros - Users
Route::get('/users/livros', [LivroUserController::class, 'index']);
Route::get('/livros/user/{id}', [LivroUserController::class, 'show']);

// Protected Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
	Route::post('/logout', [AuthController::class, 'logout']);
	Route::post('/livros', [LivroController::class, 'store']);
	Route::post('/livros/user', [LivroUserController::class, 'store']);
	Route::put('/livros/{id}', [LivroController::class, 'update']);
	Route::delete('/livros/{id}', [LivroController::class, 'destroy']);
	Route::delete('/user/livro', [LivroUserController::class, 'destroy']);
});

