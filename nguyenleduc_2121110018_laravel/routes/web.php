<?php

use Illuminate\Support\Facades\Route;
#Controller backend

use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\ConfigController;
use App\Http\Controllers\backend\BrandController;
use App\Http\Controllers\backend\MenuController;
use App\Http\Controllers\backend\DashboarController;
use App\Http\Controllers\backend\ContactController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\backend\OrderController;
use App\Http\Controllers\backend\OrderdetailController;
use App\Http\Controllers\backend\PostController;
use App\Http\Controllers\backend\SliderController;
use App\Http\Controllers\backend\TopicController;
#Controller frontent
use App\Http\Controllers\frontend\SiteController;
use App\Models\Category;
use PSpell\Config;

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

Route::get('/', [SiteController::class,'index'])->name('site.index');

Route::prefix('admin')->group(function()
{
    //Trang bang dieu khien
    Route::get('/', [DashboarController::class,'index'])->name('dashboard.index');
    Route::get('product/trash',[ProductController::class,'trash'])->name('product.trash');
    Route::resource('product', ProductController::class);
    
    Route::get('category/trash',[CategoryController::class,'trash'])->name('category.trash');
    Route::resource('category', CategoryController::class);

    Route::get('config/trash',[ConfigController::class,'trash'])->name('config.trash');
    Route::resource('config', ConfigController::class);

    Route::get('brand/trash',[BrandController::class,'trash'])->name('brand.trash');
    Route::resource('brand', BrandController::class);

    Route::get('menu/trash',[MenuController::class,'trash'])->name('menu.trash');
    Route::resource('menu', MenuController::class);

    Route::get('contact/trash',[ContactController::class,'trash'])->name('contact.trash');
    Route::resource('contact', ContactController::class);

    Route::get('order/trash',[OrderController::class,'trash'])->name('order.trash');
    Route::resource('order', OrderController::class);

    Route::get('orderdetail/trash',[OrderdetailController::class,'trash'])->name('orderdetail.trash');
    Route::resource('orderdetail', OrderdetailController::class);

    Route::get('post/trash',[PostController::class,'trash'])->name('post.trash');
    Route::resource('post', PostController::class);

    Route::get('slider/trash',[SliderController::class,'trash'])->name('slider.trash');
    Route::resource('slider', SliderController::class);

    Route::get('topic/trash',[TopicController::class,'trash'])->name('topic.trash');
    Route::resource('topic', TopicController::class);

    Route::get('user/trash',[UserController::class,'trash'])->name('user.trash');
    Route::resource('user', UserController::class);
});
