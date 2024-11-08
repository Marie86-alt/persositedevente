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
use Illuminate\Http\Request;







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

    Route::get('/ordrs/details', [YourController::class, 'showOrderDetails'])->name('orders.details');
    Route::get('/orders/track', 'OrderController@track')->name('orders.track');
    //Route::get('/orders/track', 'OrderController@track')->name('orders.track')->middleware('auth');
    Route::post('/cart/validate', [CartController::class, 'validateCart'])->name('cart.validate');
    
    // Routes pour le paiement

    Route::get('/checkout', [PaymentController::class, 'checkout'])->name('checkout');
    Route::get('/checkout/success', [PaymentController::class, 'success'])->name('checkout-success');
    Route::get('/checkout/cancel', [PaymentController::class, 'cancel'])->name('checkout-cancel');





    // Routes pour le panier
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/apply-coupon', [CartController::class, 'applyCoupon'])->name('cart.applyCoupon');


// Routes pour les pages d'administration
    Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::get('products', [AdminController::class, 'manageProducts'])->name('products.index');
    Route::get('orders', [AdminController::class, 'manageOrders'])->name('orders.index');
    Route::get('users', [AdminController::class, 'manageUsers'])->name('users.index');
});

require __DIR__.'/auth.php';