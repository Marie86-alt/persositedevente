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

        // Calculer le total
    $total = array_reduce(session('cart', []), function ($carry, $item) {
        return $carry + ($item['price'] * $item['quantity']);
    }, 0);
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

    public function add(Request $request)
{
    $product = Product::find($request->id);
    if (!$product) {
        return response()->json(['error' => 'Produit non trouvé.'], 404);
    }

    $cart = session()->get('cart', []);

    if (isset($cart[$product->id])) {
        $cart[$product->id]['quantity'] += $request->quantity;
    } else {
        $cart[$product->id] = [
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $request->quantity
        ];
    }

    session()->put('cart', $cart);

    return response()->json(['success' => 'Produit ajouté au panier.']);
}

public function remove(Request $request)
{
    $cart = session()->get('cart', []);

    if (isset($cart[$request->id])) {
        unset($cart[$request->id]);
        session()->put('cart', $cart);

        return response()->json(['success' => 'Produit retiré du panier.', 'cart' => $cart]);
    }

    return response()->json(['error' => 'Produit non trouvé dans le panier.'], 404);
}
public function updateSession(Request $request)
{
    $cart = session()->get('cart', []);

    if (isset($cart[$request->id])) {
        $cart[$request->id]['quantity'] = $request->quantity;
        session()->put('cart', $cart);

        return response()->json(['success' => 'Quantité mise à jour.', 'cart' => $cart]);
    }

    return response()->json(['error' => 'Produit non trouvé dans le panier.'], 404);
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
