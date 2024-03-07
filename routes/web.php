<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MaterialFormController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\RoleController;

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
    return redirect()->route('home');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/materialForm1', [MaterialFormController::class, 'index'])->name('material.form.1');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('products', ProductController::class);
    Route::get('/users', [PeopleController::class, 'index'])->name('users');
    Route::get('/users/create', [PeopleController::class, 'create'])->name('users.create');
    Route::post('/users/create', [PeopleController::class, 'store'])->name('users.store');
    Route::get('/users/edit/{id}', [PeopleController::class, 'edit'])->name('users.edit');
    Route::post('/users/update/{id}', [PeopleController::class, 'update'])->name('users.update');
    Route::get('/users/delete/{id}', [PeopleController::class, 'delete'])->name('users.delete');
});
