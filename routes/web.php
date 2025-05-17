<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DashboardController;
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

    Route::get('/auth/logout', [AuthController::class, 'logout'])->name('auth-logout');

});

Route::middleware(['guest'])->group(function () {

    Route::get('/admin/login', [AuthController::class, 'index'])->name('auth-admin-index');
    Route::post('/admin/login', [AuthController::class, 'login'])->name('auth-admin-login');
    
});

Route::get('/', function () {
    return view('welcome');
});
