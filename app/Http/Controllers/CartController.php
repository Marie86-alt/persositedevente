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

public function validateCart(Request $request)
{
    // Vérifiez si l'utilisateur est authentifié
    if (!Auth::check()) {
        return response()->json(['success' => false, 'message' => 'Vous devez être connecté pour valider votre panier.']);
    }

    // Récupérer le contenu du panier
    $cart = session('cart', []);

    // Vérifiez si le panier n'est pas vide
    if (empty($cart)) {
        return response()->json(['success' => false, 'message' => 'Votre panier est vide.']);
    }

    // Créez une nouvelle commande
    $order = new Order();
    $order->user_id = Auth::id(); // Associe la commande à l'utilisateur connecté
    $order->total = array_sum(array_column($cart, 'price')); // Calculer le total (vous pouvez le modifier selon votre logique)
    $order->status = 'en attente'; // État initial de la commande
    $order->save();

    // Ajoutez les articles de la commande (selon votre logique)
    foreach ($cart as $item) {
        $order->items()->create([ // Assurez-vous que la relation est définie dans le modèle Order
            'product_id' => $item['id'], // Remplacez par l'identifiant du produit
            'quantity' => $item['quantity'],
            'price' => $item['price'],
        ]);
    }

    // Videz le panier
    session()->forget('cart');

    // Retournez une réponse JSON
    return response()->json(['success' => true, 'message' => 'Votre panier a été validé avec succès !']);
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
