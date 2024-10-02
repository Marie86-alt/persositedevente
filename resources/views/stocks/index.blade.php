@extends('layouts.app')

@section('title', 'Liste des Stocks')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Liste des Stocks</h1>

    <a href="{{ route('stocks.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Ajouter un stock</a>

    <table class="min-w-full bg-white mt-4">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="w-1/3 px-4 py-2">Nom du Produit</th>
                <th class="w-1/3 px-4 py-2">Quantité</th>
                <th class="w-1/4 px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stocks as $stock)
            <tr class="text-center">
                <td class="border px-4 py-2">{{ $stock->product_name }}</td>
                <td class="border px-4 py-2">{{ $stock->quantity }}</td>
                <td class="border px-4 py-2">
                    <a href="{{ route('stocks.show', $stock->id) }}" class="text-blue-500">Voir</a>
                    <a href="{{ route('stocsk.edit', $stock->id) }}" class="text-yellow-500 ml-2">Modifier</a>
                    <form action="{{ route('stocks.destroy', $stock->id) }}" method="POST" class="inline-block ml-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
