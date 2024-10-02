@extends('layouts.app')

@section('title', 'Détails du Stock')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">{{ $stock->product_name }}</h1>

    <div class="mb-4">
        <strong>Quantité:</strong> {{ $stock->quantity }}
    </div>

    <a href="{{ route('stocks.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Retour à la liste</a>
</div>
@endsection
