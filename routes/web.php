<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\productController;
use App\Http\Controllers\accountController;

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

// Route::group(['prefix' => 'admin'], function(){
Route::group(['prefix' => 'admin','middleware'=>['checkAdmin','auth']], function(){
    Route::get('/', 'AdminController@dashboard')->name('admin.dashboard');

    Route::get('/file', 'AdminController@file')->name('admin.file');

    Route::post("/select-delivery", "infoController@select_delivery");
    Route::post("/select-thanhpho", "cosoController@select_thanhpho");
    Route::get('/chi-tiet-don-hang/{slug}', 'donhangController@chitietdh');
    Route::post('/updateajax', 'dichvuController@update_ajax');
    Route::post("/update-trangthai", "donhangController@update_trangthai")->name('updatedh');
    Route::post("/filter-by-date", "AdminController@filter_by_date");
    Route::post("/order-date", "AdminController@order_date");
    Route::post("/dashboard-filter", "AdminController@dashboard_filter");
    Route::get("/loadajax", "dichvuController@loadajax")->name('loadajax');
    Route::get("/thongtin", "accountController@showaccount")->name('thongtin');
    Route::get("/updateaccount", "accountController@update_thongtin")->name('updateaccount');
    Route::delete("/delete-checked", "donhangController@deletechecked")->name('deletechecked');
    Route::delete("/delete-news", "newsController@deletenews")->name('deletenews');
    Route::delete("/delete-coso", "cosoController@deletecoso")->name('deletecoso');
    Route::delete("/delete-slide", "slideController@deleteslide")->name('deleteslide');
    Route::delete("/delete-thucung", "infoController@deletethucung")->name('deletethucung');
    Route::resources([
        'menu' => 'menuController',
        'category' => 'categoryController',
        'qlthucung' => 'infoController',
        'qlsanpham' => 'productController',
        'qldichvu' => 'cosoController',
        'chitietdichvu' => 'dichvuController',
        'datlich' => 'datlichController',
        'coupon' => 'couponController',
        'news' => 'newsController',
        'donhang' => 'donhangController',
        'chitietdh' => 'shipingController',
        'slide' => 'slideController',
        'slide-quangcao' => 'sliquangcaoController',
        'account' => 'accountController',
    ]);
});

// Route::group(['prefix' => 'user'], function(){
// Route::group(['prefix' => '/', 'checkUser'=>'auth'], function(){
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/chitiet', 'HomeController@productDetail')->name('productDetail');
    Route::get('/cua-hang', 'HomeController@products')->name('products');
    Route::get('/tin-tuc', 'HomeController@blog')->name('blog');
    Route::get('/news/{slug}', [HomeController::class, 'news'])->name('news');
    Route::get('/checkout', 'HomeController@dichvu')->name('dichvu');
    Route::get('/addToCart/{id}', [HomeController::class, 'addToCart'])->name('addToCart');
    Route::get('/gio-hang', [HomeController::class, 'cartViews'])->name('cartViews');
    Route::get('/update-cart', [HomeController::class, 'updateCart'])->name('updateCart');
    Route::get('/delete-cart', [HomeController::class, 'deleteCart'])->name('deleteCart');
    Route::get('/remove-cart', [HomeController::class, 'removeCart'])->name('removeCart');
    Route::get('/checkout', [HomeController::class, 'checkout'])->name('checkout');
    Route::get('/checkout', [HomeController::class, 'checkout'])->name('checkout');
    Route::get('/danh-muc-san-pham/{slug}', [categoryController::class, 'show_category_home']);
    Route::get('/chi-tiet-san-pham/{slug_product}', [HomeController::class, 'productDetail']);
    Route::get('/chi-tiet-san-pham/{slug}', [HomeController::class, 'productDetail']);
    Route::get('/binh-luan/{id}', [HomeController::class, 'binh_luan']);
    Route::post('/check-coupon', [HomeController::class, 'check_coupon'])->name('check_coupon');
    Route::get('/unset-coupon', [HomeController::class, 'unset_coupon']);
    Route::get('/loc-gia-sp', [HomeController::class, 'locgiasp'])->name('locgia');
    Route::post('/tim-kiem', [HomeController::class, 'search'])->name('search');


    // Route::get('/danh-muc-phu-kien', [categoryController::class, 'show_category_phukien']);   
    // Route::get('/danh-muc-san-pham/{slug_category_product}', [categoryController::class, 'show_category_home']);
    // Route::get('/chi-tiet-san-pham/{slug}', [productController::class, 'chi_tiet_san_pham']);    
    // Route::get('/active-category-product/{category_product_id}', [categoryController::class, 'active_category_product']);
    // Route::get('/unactive-category-product/{category_product_id}', [categoryController::class, 'unactive_category_product']);
    Route::get('/login-customer', [accountController::class, 'login_customer']);
    Route::post('/check-login', [accountController::class, 'check_login']);
    Route::get('/logout', [accountController::class, 'logout']);
    Route::get('/show-profile', [accountController::class, 'show_profile']);
    Route::post('/update-profile', [accountController::class, 'update_profile']);
    Route::post('/account-rating', [accountController::class, 'account_rating']);

    Route::get('/register', [accountController::class, 'register']);
    Route::post('/check-register', [accountController::class, 'check_register']);

    Route::post('/load-comment', [productController::class, 'load_comment']);
    Route::post("/select-thanhpho", "HomeController@select_thanhpho");
    Route::post("/save_checkout", "HomeController@save_checkout")->name('save_checkout');
    Route::post("/payment/online", "HomeController@createpayment")->name('payment.online');
    Route::get("/return-vnpay", "HomeController@return")->name('payment.return');

    Route::view('/contact', 'Site.contact');
    Route::view('/introduce', 'Site.introduce');
    Route::view('/blog', 'Site.blog');
    Route::view('/success', 'Site.successOrder');
    Route::get('/calendar', [HomeController::class, 'calendar'])->name('calendar');
    Route::post('/addcalendar', [HomeController::class, 'Addcalendar'])->name('addcalendar');
    Route::get('/wishlist', [HomeController::class, 'WishlistsViews'])->name('wishlist');
    Route::get('/addToWishlist/{id}', [HomeController::class, 'addtoWishlist'])->name('addtowishlist');
    Route::get('/deleteWishlist', [HomeController::class, 'deleteWishlist'])->name('deletewishlist1');
    
// });

Auth::routes();

// Route::get('/', [HomeController::class, 'index']);
// Route::get('/trang-chu', [HomeController::class, 'index']);
