<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admin\AdminController;








Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// Page d'accueil
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/products', [ProductController::class, 'index'])->name('product.index');
Route::get('/users', [UserController::class, 'index'])->name('user.index');
Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');

// Routes CRUD pour les produits
Route::resource('products', ProductController::class);
Route::resource('categories', CategoryController::class);
Route::resource('suppliers', SupplierController::class);
Route::resource('stock', StockController::class);
Route::resource('payment', PaymentController::class);


// Routes CRUD pour le panier
Route::resource('cart', CartController::class);

// Routes CRUD pour les commandes
Route::resource('orders', OrderController::class);

// Routes CRUD pour les utilisateurs
Route::resource('users', UserController::class);

// Routes pour les pages d'administration
Route::get('admin', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('admin/products', [AdminController::class, 'manageProducts'])->name('admin.products.index');
Route::get('admin/orders', [AdminController::class, 'manageOrders'])->name('admin.orders.index');
Route::get('admin/users', [AdminController::class, 'manageUsers'])->name('admin.users.index');