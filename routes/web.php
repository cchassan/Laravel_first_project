<?php

use App\Http\Controllers\SecondaryPackagingFormatController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MaterialFormController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MaterialReceivingFormController;
use App\Http\Controllers\GoodReceivingNotesController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductRecipeController;
use App\Http\Controllers\RouteAdministrationController;

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

Route::group(['middleware' => ['auth']], function() {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/locations', [LocationController::class, 'index'])->name('location');
    Route::post('/location/store', [LocationController::class, 'store'])->name('location.store');
    Route::get('/location/{id}/edit', [LocationController::class, 'edit'])->name('location.edit');
    Route::get('/location/{id}/delete', [LocationController::class, 'destroy'])->name('location.destroy');
    Route::resource('roles', RoleController::class);
    Route::get('/users', [PeopleController::class, 'index'])->name('users');
    Route::get('/users/create', [PeopleController::class, 'create'])->name('users.create');
    Route::post('/users/create', [PeopleController::class, 'store'])->name('users.store');
    Route::get('/users/edit/{id}', [PeopleController::class, 'edit'])->name('users.edit');
    Route::post('/users/update/{id}', [PeopleController::class, 'update'])->name('users.update');
    Route::get('/users/delete/{id}', [PeopleController::class, 'delete'])->name('users.delete');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update/{id}', [ProfileController::class, 'updateProfile']) -> name('profile.update');
    Route::post('/profile/updatePassword/{id}', [ProfileController::class, 'updatePassword']) -> name('profile.updatePassword');
    Route::get('/materialEntryRecord', [MaterialFormController::class, 'create'])->name('material.Entry.Record');
    Route::get('/materialEntryRecord/edit/{id}', [MaterialFormController::class, 'edit'])->name('material.Entry.Record.edit');
    Route::post('/materialEntryRecord/update/{id}', [MaterialFormController::class, 'update'])->name('material.Entry.Record.update');
    Route::get('/materialEntryRecordReport/delete/{id}', [MaterialFormController::class, 'delete'])->name('material.Entry.Record.delete');
    Route::get('/materialEntryRecordReport', [MaterialFormController::class, 'index'])->name('material.Entry.Record.Report');
    Route::post('/materialEntryRecord', [MaterialFormController::class, 'store'])->name('material.Entry.Record.store');
    Route::get('/materialReceivingForm', [MaterialReceivingFormController::class, 'create'])->name('material.Receiving.Form');
    Route::post('/materialReceivingForm/store', [MaterialReceivingFormController::class, 'store'])->name('material.Receiving.Form.store');
    Route::get('/materialReceivingForm/edit/{id}', [MaterialReceivingFormController::class, 'edit'])->name('material.Receiving.Form.edit');
    Route::post('/materialReceivingForm/update/{id}', [MaterialReceivingFormController::class, 'update'])->name('material.Receiving.Form.update');
    Route::get('/materialReceivingForm/delete/{id}', [MaterialReceivingFormController::class, 'delete'])->name('material.Receiving.Form.delete');
    Route::get('/materialReceivingReport', [MaterialReceivingFormController::class, 'index'])->name('material.Receiving.Report');
    Route::post('/get-item-codes', [MaterialReceivingFormController::class, 'getItemCodes'])->name('get.item.codes');
    Route::get('/goodsReceivingNotes', [GoodReceivingNotesController::class, 'create'])->name('goods.Receiving.Notes');
    Route::post('/getItemCode', [GoodReceivingNotesController::class, 'getItemCodesGRN'])->name('grn.get.item.codes');
    Route::post('/goodsReceivingNotes/store', [GoodReceivingNotesController::class, 'store'])->name('goods.Receiving.Notes.store');
    Route::get('/goodsReceivingReport', [GoodReceivingNotesController::class, 'index'])->name('goods.Receiving.Report');
    Route::get('/goodsReceivingReport/edit/{id}', [GoodReceivingNotesController::class, 'edit'])->name('goods.Receiving.Notes.edit');
    Route::post('/goodsReceivingReport/update/{id}', [GoodReceivingNotesController::class, 'update'])->name('goods.Receiving.Notes.update');
    Route::get('/product', [ProductController::class, 'index'])->name('product.Report');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::get('/product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
    Route::get('/productRecipe/create', [ProductRecipeController::class, 'create'])->name('productRecipe.create');
    Route::post('/get-product-codes', [ProductRecipeController::class, 'getProductCodes'])->name('get.product.codes');
    Route::post('/get-item-codes-recipe', [ProductRecipeController::class, 'getItemCodesRecipe'])->name('get.item.codes.recipe');
    Route::post('/productRecipe/store', [ProductRecipeController::class, 'store'])->name('productRecipe.store');
    Route::post('/get-route-administration', [ProductController::class, 'getRouteAdministration'])->name('get.route.administration');
    Route::post('/get-secondary-packaging-format', [ProductController::class, 'getSecondaryPackagingFormat'])->name('get.secondary.packaging.format');
    Route::get('/routeAdministration', [RouteAdministrationController::class, 'index'])->name('routeAdministration');
    Route::post('/routeAdministration/store', [RouteAdministrationController::class, 'store'])->name('routeAdministration.store');
    Route::get('/routeAdministration/{id}/edit', [RouteAdministrationController::class, 'edit'])->name('routeAdministration.edit');
    Route::get('/routeAdministration/{id}/delete', [RouteAdministrationController::class, 'destroy'])->name('routeAdministration.destroy');
    Route::get('/secondaryPackagingFormat', [SecondaryPackagingFormatController::class, 'index'])->name('secondaryPackagingFormat');
    Route::post('/secondaryPackagingFormat/store', [SecondaryPackagingFormatController::class, 'store'])->name('secondaryPackagingFormat.store');
    Route::get('/secondaryPackagingFormat/{id}/edit', [SecondaryPackagingFormatController::class, 'edit'])->name('secondaryPackagingFormat.edit');
    Route::get('/secondaryPackagingFormat/{id}/delete', [SecondaryPackagingFormatController::class, 'destroy'])->name('secondaryPackagingFormat.destroy');

});
