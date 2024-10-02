@extends('layouts.app')

@section('title', 'Modifier un Stock')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Modifier un Stock</h1>

    <form action="{{ route('stocks.update', $stock->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="product_name" class="block text-gray-700 text-sm font-bold mb-2">Nom du Produit :</label>
            <input type="text" name="product_name" id="product_name" value="{{ old('product_name', $stock->product_name) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="mb-4">
            <label for="quantity" class="block text-gray-700 text-sm font-bold mb-2">Quantité :</label>
            <input type="number" name="quantity" id="quantity" value="{{ old('quantity', $stock->quantity) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Modifier le Stock
            </button>
            <a href="{{ route('stocks.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                Annuler
            </a>
        </div>
    </form>
</div>
@endsection
