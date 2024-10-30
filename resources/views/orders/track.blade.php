@extends('layouts.app')

@section('title', 'Suivi des Commandes')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Suivi des Commandes</h1>
    
    <table class="min-w-full bg-white mt-4">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="px-4 py-2">Numéro de commande</th>
                <th class="px-4 py-2">Date</th>
                <th class="px-4 py-2">Statut</th>
                <th class="px-4 py-2">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td class="border px-4 py-2">{{ $order->id }}</td>
                <td class="border px-4 py-2">{{ $order->created_at->format('d/m/Y') }}</td>
                <td class="border px-4 py-2">{{ $order->status }}</td>
                <td class="border px-4 py-2">{{ $order->total }} €</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
