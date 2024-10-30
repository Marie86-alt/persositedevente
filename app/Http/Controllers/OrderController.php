<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\CartItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('cartItems.product')->get();
        return view('orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('cartItems.product')->findOrFail($id);
        return view('orders.show', compact('order'));
    }

    public function create()
{
    $cartItems = session('cart', []); // On récupère les articles du panier depuis la session
    $total = collect($cartItems)->sum(fn($item) => $item['price'] * $item['quantity']);
    
    return view('orders.create');
}
//
public function showOrderDetails()
{
    $cartItems = session()->get('cart', []);
    $total = array_sum(array_map(function($item) {
        return $item['price'] * $item['quantity'];
    }, $cartItems));

    return view('orders.details', compact('cartItems', 'total'));
}

public function track()
{
    $orders = Order::all(); // On récupère toutes les commandes
    return view('orders.track', compact('orders'));
}
//ou
//public function track()
/*{
    $user = Auth::user(); // Récupère l'utilisateur connecté
    $orders = $user->orders; // Récupère les commandes de cet utilisateur
    return view('orders.track', compact('orders'));
}*/

public function edit($id)
{
    $order = Order::findOrFail($id);
    return view('orders.edit', compact('order'));
}



    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'total' => 'required|numeric',
            'status' => 'required|string',
        ]);

        Order::create($validated);
        return redirect()->route('orders.index')->with('success', 'Commande créée avec succès.');
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'total' => 'required|numeric',
            'status' => 'required|string',
        ]);

        $order->update($validated);
        return redirect()->route('orders.index')->with('success', 'Commande mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Commande supprimée avec succès.');
    }
}
