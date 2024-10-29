@extends('layouts.app')

@section('title', 'Liste des Produits')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Liste des Produits</h1>
    
    <a href="{{ route('products.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Ajouter un produit</a>

    <table class="min-w-full bg-white mt-4">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="w-1/3 px-4 py-2">Nom</th>
                <th class="w-1/3 px-4 py-2">Catégorie</th>
                <th class="w-1/4 px-4 py-2">Prix</th>
                <th class="w-1/6 px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr class="text-center">
                <td class="border px-4 py-2">{{ $product->name }}</td>
                <td class="border px-4 py-2">{{ $product->category }}</td>
                <td class="border px-4 py-2">{{ $product->price }} €</td>
                <td class="border px-4 py-2">
                    <a href="{{ route('products.show', $product->id) }}" class="text-blue-500">Voir</a>
                    <a href="{{ route('products.edit', $product->id) }}" class="text-yellow-500 ml-2">Modifier</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline-block ml-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500">Supprimer</button>
                    </form>

                    <!-- Formulaire d'ajout au panier -->
                    <form action="{{ route('cart.add') }}" method="POST" class="inline-block ml-2">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <input type="number" name="quantity" value="1" min="1" class="border rounded py-1 px-2 w-16" required>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">
                            Ajouter au Panier
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
