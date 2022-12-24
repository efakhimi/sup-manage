<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\SupportRequestController;
use App\Http\Controllers\UserController;

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

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

Route::get('/', [AuthController::class, 'index'])->name('home');
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('custom-login', [AuthController::class, 'customLogin'])->name('login.custom'); 

Route::middleware('auth')->group(function() {
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('logout', [AuthController::class, 'signOut'])->name('signout'); 

    Route::controller(CategoryController::class)->group(function() {
        Route::get('/category/list', 'index')->middleware('permission:view_category')->name('categoryList');
        Route::get('/category/new', 'create')->middleware('permission:create_category')->name('categoryNew');
        Route::post('/category/new', 'store')->middleware('permission:create_category')->name('categoryNewAction');
        Route::get('/category/delete/{id?}', 'destroy')->where('id', '[0-9]+')->middleware('permission:delete_category')->name('categoryDelete');
        Route::get('/category/update/{id?}', 'edit')->where('id', '[0-9]+')->middleware('permission:edit_category')->name('categoryUpdate');
        Route::post('/category/update/{id?}', 'update')->where('id', '[0-9]+')->middleware('permission:edit_category')->name('categoryUpdateSave');
        Route::get('/category/updateStatus/{id?}', 'updateStatus')->where('id', '[0-9]+')->middleware('permission:edit_category')->name('categoryUpdateStatusSave');
    });

    Route::controller(CustomerController::class)->group(function() {
        Route::get('/customer/list', 'index')->middleware('permission:view_customer')->name('customerList');
        Route::get('/customer/new', 'create')->middleware('permission:create_customer')->name('customerNew');
        Route::post('/customer/new', 'store')->middleware('permission:create_customer')->name('customerNewAction');
        Route::get('/customer/show/{id?}', 'show')->where('id', '[0-9]+')->middleware('permission:view_customer')->name('customerShow');
        Route::get('/customer/delete/{id?}', 'destroy')->where('id', '[0-9]+')->middleware('permission:delete_customer')->name('customerDelete');
        Route::get('/customer/update/{id?}', 'edit')->where('id', '[0-9]+')->middleware('permission:edit_customer')->name('customerUpdate');
        Route::post('/customer/update/{id?}', 'update')->where('id', '[0-9]+')->middleware('permission:edit_customer')->name('customerUpdateSave');
        Route::get('/customer/updateStatus/{id?}', 'updateStatus')->where('id', '[0-9]+')->middleware('permission:edit_customer')->name('customerUpdateStatusSave');
    });

    Route::controller(ContractController::class)->group(function() {
        Route::get('/contract/list', 'index')->middleware('permission:view_contract')->name('contractList');
        Route::get('/contract/new', 'create')->middleware('permission:create_contract')->name('contractNew');
        Route::get('/contract/new/{id?}', 'createForCustomer')->where('id', '[0-9]+')->middleware('permission:create_contract')->name('contractNewForCustomer');
        Route::post('/contract/new', 'store')->middleware('permission:create_contract')->name('contractNewAction');
        Route::get('/contract/show/{id?}', 'show')->where('id', '[0-9]+')->middleware('permission:view_contract')->name('contractShow');
        Route::get('/contract/delete/{id?}', 'destroy')->where('id', '[0-9]+')->middleware('permission:delete_contract')->name('contractDelete');
        Route::get('/contract/update/{id?}', 'edit')->where('id', '[0-9]+')->middleware('permission:edit_contract')->name('contractUpdate');
        Route::post('/contract/update/{id?}', 'update')->where('id', '[0-9]+')->middleware('permission:edit_contract')->name('contractUpdateSave');
        Route::get('/contract/updateStatus/{id?}', 'updateStatus')->where('id', '[0-9]+')->middleware('permission:edit_contract')->name('contractUpdateStatusSave');
    });

    Route::controller(SupportRequestController::class)->group(function() {
        Route::get('/support/list', 'index')->middleware('permission:view_suprequest')->name('supportList');
        Route::get('/support/new', 'create')->middleware('permission:create_suprequest')->name('supportNew');
        Route::get('/support/new/{id?}', 'createForCustomer')->middleware('permission:create_suprequest')->where('id', '[0-9]+')->name('supportNewForCustomer');
        Route::post('/support/new', 'store')->middleware('permission:create_suprequest')->name('supportNewAction');
        Route::get('/support/show/{id?}', 'show')->where('id', '[0-9]+')->middleware('permission:view_suprequest')->name('supportShow');
        Route::get('/support/delete/{id?}', 'destroy')->where('id', '[0-9]+')->middleware('permission:delete_suprequest')->name('supportDelete');
        Route::get('/support/update/{id?}', 'edit')->where('id', '[0-9]+')->middleware('permission:edit_suprequest')->name('supportUpdate');
        Route::post('/support/update/{id?}', 'update')->where('id', '[0-9]+')->middleware('permission:edit_suprequest')->name('supportUpdateSave');
        Route::get('/support/updateStatus/{id?}', 'updateStatus')->where('id', '[0-9]+')->middleware('permission:edit_suprequest')->name('supportUpdateStatusSave');
        Route::get('/support/setEnd/{id?}', 'setEnd')->where('id', '[0-9]+')->middleware('permission:edit_suprequest')->name('supportUpdateEnd');
    });

    Route::controller(UserController::class)->group(function() {
        Route::get('/role/new', 'createRole')->middleware('permission:create_roles')->name('roleNew');
        Route::post('/role/new', 'storeRole')->middleware('permission:create_roles')->name('roleNewAction');
        Route::get('/user/profile', 'profile')->name('userProfile');
        Route::post('/user/edit', 'profileStore')->name('userEditProfileStore');
        Route::get('/users/list', 'index')->middleware('permission:view_user')->name('usersList');
        Route::get('/users/new', 'create')->middleware('permission:create_user')->name('usersNew');
        Route::post('/users/new', 'store')->middleware('permission:create_user')->name('usersNewAction');
        Route::get('/users/show/{id?}', 'show')->where('id', '[0-9]+')->middleware('permission:view_user')->name('usersShow');
        Route::get('/users/delete/{id?}', 'destroy')->where('id', '[0-9]+')->middleware('permission:delete_user')->name('usersDelete');
        Route::post('/users/update/{id?}', 'update')->where('id', '[0-9]+')->middleware('permission:edit_user')->name('usersUpdateSave');
        Route::get('/users/updateStatus/{id?}', 'updateStatus')->where('id', '[0-9]+')->middleware('permission:edit_user')->name('usersUpdateStatusSave');
    });
        
});