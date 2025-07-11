<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\PostController;
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

Route::middleware(['auth'])->group(function () {

    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin-dashboard');

    Route::get('/admin/post', [PostController::class, 'index'])->name('admin-post');
    Route::get('/admin/post/create', [PostController::class, 'create'])->name('admin-post-create');
    Route::post('/admin/post', [PostController::class, 'store'])->name('admin-post-store');
    Route::get('/admin/post/edit/{id}', [PostController::class, 'edit'])->name('admin-post-edit');
    Route::put('/admin/post/{id}', [PostController::class, 'update'])->name('admin-post-update');
    Route::get('/admin/post/{id}', [PostController::class, 'trash'])->name('admin-post-trash');
    Route::post('/admin/post/{id}', [PostController::class, 'restore'])->name('admin-post-restore');
    Route::delete('/admin/post/{id}', [PostController::class, 'destroy'])->name('admin-post-destroy');

    Route::get('/admin/role', [RoleController::class, 'index'])->name('admin-role');
    Route::get('/admin/role/create', [RoleController::class, 'create'])->name('admin-role-create');
    Route::post('/admin/role', [RoleController::class, 'store'])->name('admin-role-store');
    Route::get('/admin/role/edit/{id}', [RoleController::class, 'edit'])->name('admin-role-edit');
    Route::put('/admin/role/{id}', [RoleController::class, 'update'])->name('admin-role-update');
    Route::delete('/admin/role/{id}', [RoleController::class, 'destroy'])->name('admin-role-destroy');

    Route::get('/admin/user', [UserController::class, 'index'])->name('admin-user');
    Route::get('/admin/user/create', [UserController::class, 'create'])->name('admin-user-create');
    Route::post('/admin/user', [UserController::class, 'store'])->name('admin-user-store');
    Route::get('/admin/user/edit/{id}', [UserController::class, 'edit'])->name('admin-user-edit');
    Route::put('/admin/user/{id}', [UserController::class, 'update'])->name('admin-user-update');
    Route::delete('/admin/user/{id}', [UserController::class, 'destroy'])->name('admin-user-destroy');

    Route::get('/admin/media', [MediaController::class, 'index'])->name('admin-media');
    Route::post('/admin/media', [MediaController::class, 'store'])->name('admin-media-store');
    Route::post('/admin/media/load-more', [MediaController::class, 'load_more'])->name('admin-media-load-more');
    Route::get('/admin/media/detail', [MediaController::class, 'detail'])->name('admin-media-detail');
    Route::put('/admin/media/{id?}', [MediaController::class, 'update'])->name('admin-media-update');
    Route::delete('/admin/media/{id?}', [MediaController::class, 'destroy'])->name('admin-media-destroy');
    Route::post('/admin/media/search', [MediaController::class, 'search'])->name('admin-media-search');

    Route::get('/admin/option', [OptionController::class, 'index'])->name('admin-option');
    Route::get('/admin/option/create', [OptionController::class, 'create'])->name('admin-option-create');
    Route::post('/admin/option', [OptionController::class, 'store'])->name('admin-option-store');
    Route::get('/admin/option/edit/{id}', [OptionController::class, 'edit'])->name('admin-option-edit');
    Route::put('/admin/option/{id}', [OptionController::class, 'update'])->name('admin-option-update');
    Route::delete('/admin/option/{id}', [OptionController::class, 'destroy'])->name('admin-option-destroy');

    Route::get('/admin/logout', [AuthController::class, 'logout'])->name('auth-admin-logout');

});

Route::middleware(['guest'])->group(function () {

    Route::get('/admin/login', [AuthController::class, 'index'])->name('auth-admin-index');
    Route::post('/admin/login', [AuthController::class, 'login'])->name('auth-admin-login');
    
});

Route::get('/', function () {
    return view('welcome');
});
