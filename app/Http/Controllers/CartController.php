<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = CartItem::with('product')->get();
        return view('cart.index', compact('cartItems'));
    }

    public function show($id)
    {
        $cartItem = CartItem::with('product')->findOrFail($id);
        return view('cart.show', compact('cartItem'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        CartItem::create($validated);
        return redirect()->route('cart.index')->with('success', 'Article ajouté au panier avec succès.');
    }

    public function update(Request $request, $id)
    {
        $cartItem = CartItem::findOrFail($id);

        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem->update($validated);
        return redirect()->route('cart.index')->with('success', 'Article mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Article supprimé du panier avec succès.');
    }
}
