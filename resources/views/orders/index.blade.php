@extends('layouts.app')

@section('title', 'Liste des Commandes')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Liste des Commandes</h1>

    <a href="{{ route('orders.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Ajouter une commande</a>

    <table class="min-w-full bg-white mt-4">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="w-1/4 px-4 py-2">Nom du Client</th>
                <th class="w-1/4 px-4 py-2">Date de la Commande</th>
                <th class="w-1/4 px-4 py-2">Montant Total</th>
                <th class="w-1/4 px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr class="text-center">
                <td class="border px-4 py-2">{{ $order->customer_name }}</td>
                <td class="border px-4 py-2">{{ $order->order_date }}</td>
                <td class="border px-4 py-2">{{ $order->total_amount }} €</td>
                <td class="border px-4 py-2">
                    <a href="{{ route('orders.show', $order->id) }}" class="text-blue-500">Voir</a>
                    <a href="{{ route('orders.edit', $order->id) }}" class="text-yellow-500 ml-2">Modifier</a>
                    <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="inline-block ml-2">
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
