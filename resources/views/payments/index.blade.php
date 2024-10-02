@extends('layouts.app')

@section('title', 'Liste des Paiements')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">Liste des Paiements</h1>

    @if (session('success'))
        <div class="bg-green-500 text-white p-4 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('payments.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Ajouter un Paiement</a>

    <table class="min-w-full mt-4 bg-white border rounded-lg shadow-lg">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Montant</th>
                <th class="px-4 py-2">Méthode de Paiement</th>
                <th class="px-4 py-2">Statut</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payments as $payment)
            <tr class="border-t">
                <td class="px-4 py-2">{{ $payment->id }}</td>
                <td class="px-4 py-2">{{ $payment->amount }} €</td>
                <td class="px-4 py-2">{{ $payment->payment_method }}</td>
                <td class="px-4 py-2">{{ $payment->status }}</td>
                <td class="px-4 py-2">
                    <a href="{{ route('payments.show', $payment->id) }}" class="text-blue-500 hover:text-blue-700">Voir</a>
                    <a href="{{ route('payments.edit', $payment->id) }}" class="text-yellow-500 hover:text-yellow-700 ml-2">Modifier</a>
                    
                    <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" class="inline-block ml-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
