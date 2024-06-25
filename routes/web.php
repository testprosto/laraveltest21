<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ShowUserController;

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



Route::resource('posts', PostController::class);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/users', function () {
    return view('users');
});



Route::get('profile/search', function () {
    return view('profile.search');
})->name('profile.search');

Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/user/{id}', [ShowUserController::class, 'show'])->name('user.usershow');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile', [ProfileController::class, 'updateavatar'])->name('profile.updateavatar');


});

require __DIR__ . '/auth.php';



Route::post('/image/upload', [ProfileController::class, 'uploadImage'])->name('image.upload');

Route::post('/posts', [PostController::class, 'store'])->name('posts.store');


Route::delete('posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
Route::put('posts/{id}', [PostController::class, 'update'])->name('posts.update');
Route::get('allposts', [PostController::class, 'allposts'])->name('posts.allposts');
Route::get('/fashion', [PostController::class, 'fashionpost'])->name('posts.categorias.fashion');
Route::get('/electronics', [PostController::class, 'electronicspost'])->name('posts.categorias.electronics');
Route::get('/toys_and_hobbies', [PostController::class, 'toys_and_hobbiespost'])->name('posts.categorias.toys_and_hobbies');
Route::post('/posts/buy', [PostController::class, 'buy'])->name('posts.buy');


Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
Route::post('/language-switch', [LanguageController::class, 'languageSwitch'])->name('language.switch');

Route::post('/posts/add', [PostController::class, 'add'])->name('posts.add');