<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Main\ViewController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Author\AuthorController;
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

Route::get('/buku', [ViewController::class, 'index'])->name('view.index');
Route::get('/buku/daftar', [ViewController::class, 'login'])->name('view.daftar');
Route::get('/buku/buku-pilihan', [ViewController::class, 'bukuPilihan'])->name('view.bukuPilihan');


Route::group(['middleware' => ['guest']], function () {
    Route::get('/login', [LoginController::class, 'login' ])->name('auth.login');
});

// Login and Register
Route::post('/login/store', [LoginController::class, 'store' ])->name('login.store');
Route::post('/register/store', [RegisterController::class, 'store' ])->name('register.store');
Route::get('/login/logout', [LoginController::class, 'logout' ])->name('logout');



// Route::middleware(['auth', 'is_admin:0'])->group(function () {
//     Route::get('/buku', function () {
//         return view('main.index');
//     });
// });


// Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'is_admin:1'])->group(function () {
    // Caterogy
    Route::get('/category', [CategoryController::class, 'index'])->name ('category.index')->middleware('is_admin');
    Route::get('/category/form', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::get('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

    // Publisher
    Route::get('/publisher', [PublisherController::class, 'index'])->name('publisher.index');
    Route::get('/publisher/form', [PublisherController::class, 'create'])->name('publisher.create');
    Route::post('/publisher/store', [PublisherController::class, 'store'])->name('publisher.store');
    Route::get('/publisher/edit/{id}', [PublisherController::class, 'edit'])->name('publisher.edit');
    Route::put('/publisher/{id}', [PublisherController::class, 'update'])->name('publisher.update');
    Route::get('/publisher/delete/{id}', [PublisherController::class, 'destroy'])->name('publisher.destroy');

    // Author
    Route::get('/author', [AuthorController::class, 'index'])->name('author.index');
    Route::get('/author/form', [AuthorController::class, 'create'])->name('author.create');
    Route::post('/author/store', [AuthorController::class, 'store'])->name('author.store');
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

});


