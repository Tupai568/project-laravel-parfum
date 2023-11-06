<?php

use App\Models\Post;
use App\Models\Categories;
use Clockwork\Storage\Search;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ComentController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\DataUserController;
use App\Http\Controllers\AdminPostController;

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

Route::get('/tester', function() {
    return view('template.sidebar', [
        'judul' => 'Tester'
    ]);
});

Route::get('/', [PostController::class, 'index'])->name('login'); //name untuk direct jika login dari route post gagal

Route::get('/category/{category:name}', [PostController::class, 'category']); //name untuk direct jika login dari route post gagal

Route::get('/category', [PostController::class, 'everything']); //name untuk direct jika login dari route post gagal

Route::get('/detail/{detail}', [PostController::class, 'detail']);

Route::post('/search', [SearchController::class, 'index']);

Route::post('/like', [LikeController::class, 'index'])->middleware('auth');

Route::post('/login', [LoginController::class, 'authenticate'])->middleware('guest');

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

Route::post('/register', [LoginController::class, 'store'])->middleware('guest');

Route::post('/coment', [ComentController::class, 'store'])->middleware('auth');

Route::post('/replie', [ComentController::class, 'replie'])->middleware('auth');

Route::get('/dataUser', [DataUserController::class, 'index'])->middleware('admin');

Route::post('/changeStatusUser', [DataUserController::class, 'update'])->middleware('admin');

Route::post('/deleteUser', [DataUserController::class, 'destroy'])->middleware('admin');

Route::resource('/dashboard/admin/posts', AdminPostController::class)->middleware('admin'); //buat midleware untuk admin, make midleware, lalu setting kernel.php