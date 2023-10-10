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
use App\Http\Controllers\backend\ImportController;
use App\Http\Controllers\backend\ExportController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\backend\OrderController;
use App\Http\Controllers\backend\OrderdetailController;
use App\Http\Controllers\backend\PageController;
use App\Http\Controllers\backend\PostController;
use App\Http\Controllers\backend\SliderController;
use App\Http\Controllers\backend\TopicController;
use App\Http\Controllers\backend\AuthController;
#Controller frontent
use App\Http\Controllers\frontend\SiteController;
use App\Http\Controllers\frontend\SanPhamController;
use App\Http\Controllers\frontend\BaiVietController;
use App\Http\Controllers\frontend\GioHangController;
use App\Http\Controllers\frontend\LienHeController;
use App\Http\Controllers\frontend\TimKiemController;

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
//khai baso trang người dùng
Route::get('/', [SiteController::class, 'index'])->name('site.index');

//login admin
Route::get('/admin/login', [AuthController::class, 'getlogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'postLogin'])->name('admin.postLogin');



//khai báo trang quản lí 
Route::prefix('admin')->group(function () {
    //Trang bang dieu khien
    Route::get('/', [DashboarController::class, 'index'])->name('dashboard.index');
    Route::get('product/trash', [ProductController::class, 'trash'])->name('product.trash');
    Route::resource('product', ProductController::class);

    Route::get('category/trash', [CategoryController::class, 'trash'])->name('category.trash');
    Route::resource('category', CategoryController::class);
    Route::get('category/status/{category}', [CategoryController::class, 'status'])->name('category.status');
    Route::get('category/delete/{category}', [CategoryController::class, 'delete'])->name('category.delete');
    Route::get('category/restore/{category}', [CategoryController::class, 'restore'])->name('category.restore');
    Route::resource('category', CategoryController::class);
    
    Route::get('config/trash', [ConfigController::class, 'trash'])->name('config.trash');
    Route::resource('config', ConfigController::class);

    Route::get('brand/trash', [BrandController::class, 'trash'])->name('brand.trash');
    Route::resource('brand', BrandController::class);
    Route::get('brand/status/{brand}', [BrandController::class, 'status'])->name('brand.status');
    Route::get('brand/delete/{brand}', [BrandController::class, 'delete'])->name('brand.delete');
    Route::get('brand/restore/{brand}', [BrandController::class, 'restore'])->name('brand.restore');
    Route::resource('brand', BrandController::class);

    Route::get('import/trash', [ImportController::class, 'trash'])->name('import.trash');
    Route::resource('import', ImportController::class);
    Route::get('import/status/{import}', [ImportController::class, 'status'])->name('import.status');
    Route::get('import/delete/{import}', [ImportController::class, 'delete'])->name('import.delete');
    Route::get('import/restore/{import}', [ImportController::class, 'restore'])->name('import.restore');
    Route::resource('import', ImportController::class);
    
    Route::get('menu/trash', [MenuController::class, 'trash'])->name('menu.trash');
    Route::resource('menu', MenuController::class);
    Route::get('menu/status/{menu}', [BrandController::class, 'status'])->name('menu.status');
    Route::get('menu/delete/{menu}', [BrandController::class, 'delete'])->name('menu.delete');

    Route::get('contact/trash', [ContactController::class, 'trash'])->name('contact.trash');
    Route::resource('contact', ContactController::class);

    Route::get('order/trash', [OrderController::class, 'trash'])->name('order.trash');
    Route::resource('order', OrderController::class);
    Route::get('order/status/{slider}', [OrderController::class, 'status'])->name('order.status');
    Route::get('order/delete/{slider}', [OrderController::class, 'delete'])->name('order.delete');

    Route::get('orderdetail/trash', [OrderdetailController::class, 'trash'])->name('orderdetail.trash');
    Route::resource('orderdetail', OrderdetailController::class);

    Route::get('page/trash', [PageController::class, 'trash'])->name('page.trash');
    Route::resource('page', PageController::class);
    Route::get('page/status/{page}', [PageController::class, 'status'])->name('page.status');
    Route::get('page/delete/{page}', [PageController::class, 'delete'])->name('page.delete');
    Route::get('page/restore/{page}', [PageController::class, 'restore'])->name('page.restore');
    Route::resource('page', PageController::class);
    
    Route::get('post/trash', [PostController::class, 'trash'])->name('post.trash');
    Route::resource('post', PostController::class);
    Route::get('post/status/{post}', [PostController::class, 'status'])->name('post.status');
    Route::get('post/delete/{post}', [PostController::class, 'delete'])->name('post.delete');

    Route::get('slider/trash', [SliderController::class, 'trash'])->name('slider.trash');
    Route::resource('slider', SliderController::class);
    Route::get('slider/status/{slider}', [SliderController::class, 'status'])->name('slider.status');
    Route::get('slider/delete/{slider}', [SliderController::class, 'delete'])->name('slider.delete');
    Route::get('slider/restore/{slider}', [SliderController::class, 'restore'])->name('slider.restore');
    Route::resource('slider', SliderController::class);
    
    Route::get('topic/trash', [TopicController::class, 'trash'])->name('topic.trash');
    Route::resource('topic', TopicController::class);
    Route::get('topic/status/{topic}', [TopicController::class, 'status'])->name('topic.status');
    Route::get('topic/delete/{topic}', [TopicController::class, 'delete'])->name('topic.delete');
    Route::get('topic/restore/{topic}', [TopicController::class, 'restore'])->name('topic.restore');
    Route::resource('topic', TopicController::class);
    
    
    Route::get('user/trash', [UserController::class, 'trash'])->name('user.trash');
    Route::resource('user', UserController::class);
    Route::get('user/status/{user}', [SliderController::class, 'status'])->name('user.status');
    Route::get('user/delete/{user}', [SliderController::class, 'delete'])->name('user.delete');
});