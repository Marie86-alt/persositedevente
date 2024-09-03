@extends('layouts.app')

@section('title', 'Détails du Produit')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">{{ $product->name }}</h1>
    
    <div class="mb-4">
        <strong>Catégorie:</strong> {{ $product->category }}
    </div>

    <div class="mb-4">
        <strong>Description:</strong> {{ $product->description }}
    </div>

    <div class="mb-4">
        <strong>Prix:</strong> {{ $product->price }} €
    </div>

    <div class="mb-4">
        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-64 h-64 object-cover">
    </div>

    <a href="{{ route('products.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Retour à la liste</a>
</div>
@endsection
