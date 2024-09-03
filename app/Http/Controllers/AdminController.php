<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function manageProducts()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function manageOrders()
    {
        $orders = Order::all();
        return view('admin.orders.index', compact('orders'));
    }

    public function manageUsers()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }
}
