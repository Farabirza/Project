<?php

use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\UsersController;

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

Route::get('/', function () {
    return redirect('/books');
});

Route::get('/index', function () {
    return redirect('/books');
});

Route::resource(
    'books', BooksController::class
);
// Route::get('/search', [BooksController::class, 'search']);

Route::get('/dashboard', [UsersController::class, 'dashboard'])->middleware('auth');
Route::get('/role/{user_id}', [UsersController::class, 'toggle_role']);
Route::get('/delete_user/{user_id}', [UsersController::class, 'delete_user']);
Route::get('/login', [UsersController::class, 'login']);
Route::post('/login', [UsersController::class, 'authenticate']);
Route::get('/logout', [UsersController::class, 'logout']);
Route::get('/register', [UsersController::class, 'register']);
Route::post('/register', [UsersController::class, 'store']);
Route::get('/redirect/{book_id}', [UsersController::class, 'record_visit']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
