@extends('layouts.app')

@section('title', 'Panier')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Mon Panier</h1>

    @if (session()->has('cart') && count(session('cart')) > 0)
        <div class="grid gap-4">
            @foreach (session('cart') as $key => $item)
                <div class="p-4 border rounded-lg shadow-sm bg-white">
                    <h2 class="text-lg font-semibold">{{ $item['name'] }}</h2>
                    <p>Prix: {{ $item['price'] }} $</p>
                    <p>Quantité: {{ $item['quantity'] }}</p>
                    <p>Total: {{ $item['price'] * $item['quantity'] }} $</p>
                    <div class="mt-2">
                        <a href="{{ route('product.show', $key) }}" class="text-blue-500 hover:underline">Voir le Produit</a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-yellow-100 text-yellow-800 p-4 rounded">
            Aucun produit dans le panier
        </div>
    @endif
</div>
@endsection
