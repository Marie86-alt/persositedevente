@extends('layouts.app')

@section('title', 'Créer une Commande')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Créer une Commande</h1>
    
    <!-- Formulaire d'expédition -->
    <h2 class="text-xl font-semibold mb-2">Informations d'Expédition</h2>
    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="shipping_name" class="block font-medium">Nom complet :</label>
            <input type="text" id="shipping_name" name="shipping_name" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label for="address" class="block font-medium">Adresse :</label>
            <input type="text" id="address" name="address" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label for="city" class="block font-medium">Ville :</label>
            <input type="text" id="city" name="city" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label for="postal_code" class="block font-medium">Code postal :</label>
            <input type="text" id="postal_code" name="postal_code" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4 mt-6">
    <label for="shipping_option" class="block font-medium">Option de Livraison :</label>
    <select id="shipping_option" name="shipping_option" class="w-full border rounded px-3 py-2">
        <option value="standard">Livraison Standard (3-5 jours) - Gratuit</option>
        <option value="express">Livraison Express (1-2 jours) - 10 €</option>
    </select>
</div>


        <!-- Informations de paiement -->
        <h2 class="text-xl font-semibold mt-6 mb-2">Informations de Paiement</h2>
        <div class="mb-4">
            <label for="card_number" class="block font-medium">Numéro de carte :</label>
            <input type="text" id="card_number" name="card_number" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label for="expiry_date" class="block font-medium">Date d'expiration :</label>
            <input type="text" id="expiry_date" name="expiry_date" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label for="cvv" class="block font-medium">CVV :</label>
            <input type="text" id="cvv" name="cvv" class="w-full border rounded px-3 py-2" required>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Valider la Commande</button>
    </form>

    <!-- Section Récapitulatif de la Commande -->
    <h2 class="text-xl font-semibold mt-6 mb-2">Récapitulatif de la Commande</h2>
    @php
        $cartItems = session()->get('cart', []);
        $total = array_sum(array_map(function($item) {
            return $item['price'] * $item['quantity'];
        }, $cartItems));
    @endphp

    <table class="min-w-full bg-white mt-4">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="px-4 py-2">Produit</th>
                <th class="px-4 py-2">Quantité</th>
                <th class="px-4 py-2">Prix</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cartItems as $item)
            <tr>
                <td class="border px-4 py-2">{{ $item['name'] }}</td>
                <td class="border px-4 py-2">{{ $item['quantity'] }}</td>
                <td class="border px-4 py-2">{{ $item['price'] }} €</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" class="text-right font-bold">Total :</td>
                <td class="border px-4 py-2">{{ $total }} €</td>
            </tr>
        </tfoot>
    </table>
</div>
@endsection
