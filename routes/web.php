
<?php

use App\Http\Controllers\Admin\AdminOrderController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Book\BookController;
use App\Http\Controllers\Main\CartController;
use App\Http\Controllers\Main\ViewController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Author\AuthorController;
use App\Http\Controllers\Coupon\CouponController;
use App\Http\Controllers\Main\CheckoutController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Publisher\PublisherController;
use App\Http\Controllers\Warehouse\WarehouseController;

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

Route::prefix('/buku')->name('view.')->group(function ()
{
    // Route::get('/buku/daftar', [ViewController::class, 'login'])->name('view.daftar');
    Route::get('/', [ViewController::class, 'index'])->name('index');
    Route::get('/register', [ViewController::class, 'register'])->name('register');
    Route::get('/login', [ViewController::class, 'login'])->name('login');
    Route::get('/buku-pilihan', [ViewController::class, 'bukuPilihan'])->name('bukuPilihan');
    Route::get('/products/{slug}', [ViewController::class, 'bukuProducts'])->name('bukuProducts');
    
});

// Auth::routes(['verify'=>true]);


// guest
// Route::group(['middleware' => ['guest']], function () {
    Route::get('/login', [LoginController::class, 'login' ])->name('auth.login');
    // Login and Register
    Route::post('/login/store', [LoginController::class, 'store' ])->name('login.store');
    Route::post('/register/store', [RegisterController::class, 'store' ])->name('register.store');
    Route::get('/login/logout', [LoginController::class, 'logout' ])->name('logout');
    Route::post('/payment', [OrderController::class, 'payment_post'])->name('payment');
    // Route::post('/payment-handler', [ApiController::class, 'payment_handler'])->name('payment_handler');
    // Route::post('/midtrans-callback', [OrderController::class, 'callback'])->name('midtrans-callback');

// });



Route::middleware(['auth'])->group(function () {
    Route::post('/add-to-cart', [CartController::class, 'addBook'])->name('cartAdd');
    Route::post('/delete-item', [CartController::class, 'deleteBook'])->name('cartDelete');
    Route::post('/cart-update', [CartController::class, 'updateCart'])->name('cartUpdate');
    Route::post('/cart-checkout', [CartController::class, 'checkout_post'])->name('cartCheckout');
    Route::post('/cart-checkout-update', [CartController::class, 'checkout_post_update'])->name('cartCheckoutUpdate');
    Route::post('/cart-midtranspay', [CartController::class, 'midtransPay'])->name('midtransPay');
    Route::get('buku/cart', [CartController::class, 'view'])->name('cartView'); 
    Route::post('/cart/massdelete', [CartController::class, 'massDelete'])->name('carMassDelete'); 

    Route::post('/order-add', [OrderController::class, 'addOrder'])->name('addOrder');
    Route::post('/updateongkir', [OrderController::class, 'updateOngkir'])->name('updateOngkir');

    Route::get('/buku/payment/{order_id}', [OrderController::class, 'pembayaran'])->name('paymentView');

    Route::get('/cekongkir', [CheckoutController::class, 'cekOngkir'])->name('cekongkir');
    Route::post('/cekongkir', [CheckoutController::class, 'cekOngkir'])->name('cekongkirpost');

    Route::get('buku/checkout', [CheckoutController::class, 'view'])->name('checkoutView');

    Route::post('/coupon/check', [CouponController::class, 'check'])->name('coupon.check');
    Route::post('/coupon-cancel', [CouponController::class, 'cancelCoupon'])->name('coupon.cancel');



    Route::get('buku/orders', [ViewController::class, 'riwayatPembelian'])->name('riwayatView');
    Route::get('buku/detail-transaksi/{id}', [ViewController::class, 'detailTransaksi'])->name('detailView');

    // Route::post('buku/checkout/post', [CheckoutController::class, 'view'])->name('checkoutPost');
    Route::post('/checkout-update', [CheckoutController::class, 'updateCheckout'])->name('checkoutUpdate');
    Route::post('/province', [CheckoutController::class, 'province'])->name('province');
    Route::post('/regency', [CheckoutController::class, 'regency'])->name('regency');
    Route::post('/address', [CheckoutController::class, 'addressStore'])->name('addressStore');
}); 


// Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'is_admin:1'])->group(function () {
    // Caterogy
    Route::get('/category', [CategoryController::class, 'index'])->name ('category.index')->middleware('is_admin');
    Route::get('/category/form', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::post('/category/modalstore', [CategoryController::class, 'modalStore'])->name('category.modalStore');
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::get('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

    // Publisher
    Route::get('/publisher', [PublisherController::class, 'index'])->name('publisher.index');
    Route::get('/publisher/form', [PublisherController::class, 'create'])->name('publisher.create');
    Route::post('/publisher/store', [PublisherController::class, 'store'])->name('publisher.store');
    Route::post('/publisher/modalstore', [PublisherController::class, 'modalStore'])->name('publisher.modalStore');
    Route::get('/publisher/edit/{id}', [PublisherController::class, 'edit'])->name('publisher.edit');
    Route::put('/publisher/{id}', [PublisherController::class, 'update'])->name('publisher.update');
    Route::get('/publisher/delete/{id}', [PublisherController::class, 'destroy'])->name('publisher.destroy');

    // Author
    Route::get('/author', [AuthorController::class, 'index'])->name('author.index');
    Route::get('/author/form', [AuthorController::class, 'create'])->name('author.create');
    Route::post('/author/store', [AuthorController::class, 'store'])->name('author.store');
    Route::post('/author/modalstore', [AuthorController::class, 'modalStore'])->name('author.modalStore');
    Route::get('/author/edit/{id}', [AuthorController::class, 'edit'])->name('author.edit');
    Route::put('/author/{id}', [AuthorController::class, 'update'])->name('author.update');
    Route::get('/author/delete/{id}', [AuthorController::class, 'destroy'])->name('author.destroy');

    // Warehouse
    Route::get('/warehouse', [WarehouseController::class, 'index'])->name('warehouse.index');
    Route::get('/warehouse/form', [WarehouseController::class, 'create'])->name('warehouse.create');
    Route::post('/warehouse/store', [WarehouseController::class, 'store'])->name('warehouse.store');
    Route::get('/warehouse/edit/{id}', [WarehouseController::class, 'edit'])->name('warehouse.edit');
    Route::put('/warehouse/{id}', [WarehouseController::class, 'update'])->name('warehouse.update');
    Route::get('/warehouse/delete/{id}', [WarehouseController::class, 'destroy'])->name('warehouse.destroy');

    // Book
    Route::get('/book', [BookController::class, 'index'])->name('book.index');
    Route::get('/book/form', [BookController::class, 'create'])->name('book.create');
    Route::post('/book/store', [BookController::class, 'store'])->name('book.store');
    Route::put('/book/modalstore', [BookController::class, 'modalstore'])->name('book.modalstore');
    Route::get('/book/edit/{id}', [BookController::class, 'edit'])->name('book.edit');
    Route::put('/book/{id}', [BookController::class, 'update'])->name('book.update');
    Route::get('/book/delete/{id}', [BookController::class, 'destroy'])->name('book.destroy');

    // Coupons
    Route::get('/coupon', [CouponController::class, 'index'])->name ('coupon.index')->middleware('is_admin');
    Route::get('/coupon/form', [CouponController::class, 'create'])->name('coupon.create');
    Route::post('/coupon/store', [CouponController::class, 'store'])->name('coupon.store');
    Route::get('/coupon/delete/{id}', [CouponController::class, 'destroy'])->name('coupon.destroy');

    // Order
    Route::get('/order', [AdminOrderController::class, 'index'])->name('orderAdmin.index');
    Route::post('/order-count', [AdminOrderController::class, 'orderCount'])->name('orderAdmin.count');
    Route::get('/order/detail/{order_id}', [AdminOrderController::class, 'detail'])->name('orderAdmin.detail');
    Route::post('/order/complete/{id}', [AdminOrderController::class, 'completeOrder'])->name('orderAdmin.complete');
    Route::post('/order/delete/{id}', [AdminOrderController::class, 'deleteOrder'])->name('orderAdmin.delete');


    // User
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/role/{id}', [Usercontroller::class, 'role'])->name('user.role');
    Route::get('/user/delete/{id}', [UserController::class, 'destroy'])->name('user.destroy');



    // testing
    
    


});


