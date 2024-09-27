@extends('layouts.app')

@section('title', 'Détails de la Commande')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Détails de la Commande</h1>
    
    <div class="mb-4">
        <strong>Nom du Client :</strong> {{ $order->customer_name }}
    </div>

    <div class="mb-4">
        <strong>Date de la Commande :</strong> {{ $order->order_date }}
    </div>

    <div class="mb-4">
        <strong>Montant Total :</strong> {{ $order->total_amount }} €
    </div>

    <a href="{{ route('orders.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Retour à la liste</a>
</div>
@endsection
