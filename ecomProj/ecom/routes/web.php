<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use Illuminate\Support\Facades\Route;

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
});

Route::group(['middleware' => ['AdminAuth']], function(){
    Route::get('admin/dashboard',[AdminController::class,'dashboard']); 

    Route::get('admin/category',[CategoryController::class,'index']);
    Route::get('admin/category/manage_category',[CategoryController::class, 'manage_category']);
    Route::get('admin/category/manage_category/{id}',[CategoryController::class, 'manage_category']);
    Route::post('admin/category/manage_category_process',[CategoryController::class, 'manage_category_process'])->name('category.insert');
    Route::get('admin/category/delete/{id}',[CategoryController::class, 'delete']);
    Route::get('admin/category/status/{status}/{id}',[CategoryController::class, 'update_status']);
        
    Route::get('admin/coupon',[CouponController::class,'index']);
    Route::get('admin/coupon/manage_coupon',[CouponController::class, 'manage_coupon']);
    Route::get('admin/coupon/manage_coupon/{id}',[CouponController::class, 'manage_coupon']);
    Route::post('admin/coupon/manage_coupon_process',[CouponController::class, 'manage_coupon_process'])->name('coupon.insert');
    Route::get('admin/coupon/delete/{id}',[CouponController::class, 'delete']); 

    Route::get('admin/logout', function(){
        session() -> forget('ADMIN_LOGGED_IN');
        session() -> forget('ADMIN_ID');
        session() -> flash('error','Logout Successfully.');
        return redirect('admin');
    });

});

Route::get('admin',[AdminController::class, 'index']);
Route::post('admin/auth',[AdminController::class,'auth']) -> name("admin.auth");
// Route::get('admin/update_password',[AdminController::class, 'update_password']);


