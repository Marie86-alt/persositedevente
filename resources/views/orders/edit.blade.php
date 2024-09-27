@extends('layouts.app')

@section('title', 'Modifier une Commande')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Modifier une Commande</h1>

    <form action="{{ route('orders.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="customer_name" class="block text-gray-700 text-sm font-bold mb-2">Nom du Client :</label>
            <input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name', $order->customer_name) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="mb-4">
            <label for="order_date" class="block text-gray-700 text-sm font-bold mb-2">Date de la Commande :</label>
            <input type="date" name="order_date" id="order_date" value="{{ old('order_date', $order->order_date) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="mb-4">
            <label for="total_amount" class="block text-gray-700 text-sm font-bold mb-2">Montant Total :</label>
            <input type="number" step="0.01" name="total_amount" id="total_amount" value="{{ old('total_amount', $order->total_amount) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Modifier la Commande
            </button>
            <a href="{{ route('orders.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                Annuler
            </a>
        </div>
    </form>
</div>
@endsection
