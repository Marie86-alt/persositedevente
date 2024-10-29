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






// Page d'accueil
Route::get('/', [HomeController::class, 'index'])->name('home');

// Routes protégées par le middleware 'auth'
// Route::middleware('auth')->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');

    // Routes pour le profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes CRUD pour les produits, catégories, fournisseurs, paiements, stocks, panier et commandes
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('stocks', StockController::class);
    Route::resource('payments', PaymentController::class); 
    Route::resource('cart', CartController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('users', UserController::class);
    Route::resource('payment', PaymentController::class);
    Route::resource('stock', StockController::class);

    // Route pour une catégorie spécifique
    Route::get('/category/{category}', [CategoryController::class, 'show'])->name('category.show');
    Route::get('products/{id}', [ProductController::class, 'show'])->name('products.show');


    // Routes pour le panier
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');


// Routes pour les pages d'administration
    Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::get('products', [AdminController::class, 'manageProducts'])->name('products.index');
    Route::get('orders', [AdminController::class, 'manageOrders'])->name('orders.index');
    Route::get('users', [AdminController::class, 'manageUsers'])->name('users.index');
});

require __DIR__.'/auth.php';