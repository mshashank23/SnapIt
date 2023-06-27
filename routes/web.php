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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/user/logout', [App\Http\Controllers\Auth\LoginController::class, 'userLogout'])->name('user.logout');
Route::post('/admin/logout', [App\Http\Controllers\Auth\LoginController::class, 'adminLogout'])->name('admin.logout');
Route::get('/opportunity', [App\Http\Controllers\HomeController::class, 'add'])->name('opportunity');
Route::post('/opportunity', [App\Http\Controllers\HomeController::class, 'store'])->name('store');
Route::get('/delete/{id}', [App\Http\Controllers\HomeController::class, 'remove'])->name('delete');
Route::get('/opportunity/update/{id}', [App\Http\Controllers\HomeController::class, 'edit'])->name('edit');
Route::put('/opportunity/update/{id}', [App\Http\Controllers\HomeController::class, 'update'])->name('update');

Route::group(['prefix' => 'admin'], function() {
	Route::group(['middleware' => 'admin.guest'], function(){
		Route::view('/login','admin.login')->name('admin.login');
		Route::post('/login',[App\Http\Controllers\AdminController::class, 'authenticate'])->name('admin.auth');
		
	});
	
	Route::group(['middleware' => 'admin.auth'], function(){
		Route::get('/dashboard',[App\Http\Controllers\DashboardController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/logout', [App\Http\Controllers\AdminController::class, 'logout'])->name('admin.logout');
        Route::get('/users', [App\Http\Controllers\AdminController::class, 'show'])->name('admin.users');
		Route::get('/users/create', [App\Http\Controllers\AdminController::class, 'create'])->name('admin.addusers');
		Route::post('/users/store', [App\Http\Controllers\AdminController::class, 'store'])->name('admin.store');
		Route::get('/delete/{id}', [App\Http\Controllers\AdminController::class, 'remove'])->name('admin.delete');
		Route::get('/edit/{id}', [App\Http\Controllers\AdminController::class, 'edit'])->name('admin.edit');
		Route::put('/update-data/{id}', [App\Http\Controllers\AdminController::class, 'update'])->name('admin.edit');
		Route::get('/opportunity', [App\Http\Controllers\AdminController::class, 'opportunity'])->name('admin.opportunity');
	});
});
