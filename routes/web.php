<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;

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
    return view('welcome');
})->name('home');

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('custom-login', [AuthController::class, 'customLogin'])->name('login.custom'); 

Route::middleware('auth')->group(function() {
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('logout', [AuthController::class, 'signOut'])->name('signout'); 

    Route::controller(CategoryController::class)->group(function() {
        Route::get('/category/list', 'index')->name('categoryList');
        Route::get('/category/new', 'create')->name('categoryNew');
        Route::post('/category/new', 'store')->name('categoryNewAction');
        Route::get('/category/delete/{id?}', 'destroy')->where('id', '[0-9]+')->name('categoryDelete');
        Route::get('/category/update/{id?}', 'edit')->where('id', '[0-9]+')->name('categoryUpdate');
        Route::post('/category/update/{id?}', 'update')->where('id', '[0-9]+')->name('categoryUpdateSave');
        Route::get('/category/updateStatus/{id?}', 'updateStatus')->where('id', '[0-9]+')->name('categoryUpdateStatusSave');
    });

    Route::controller(CustomerController::class)->group(function() {
        Route::get('/customer/list', 'index')->name('customerList');
        Route::get('/customer/new', 'create')->name('customerNew');
        Route::post('/customer/new', 'store')->name('customerNewAction');
        Route::get('/customer/delete/{id?}', 'destroy')->where('id', '[0-9]+')->name('customerDelete');
        Route::get('/customer/update/{id?}', 'edit')->where('id', '[0-9]+')->name('customerUpdate');
        Route::post('/customer/update/{id?}', 'update')->where('id', '[0-9]+')->name('customerUpdateSave');
    });
        
});