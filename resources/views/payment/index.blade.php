@extends('layouts.app')

@section('title', 'Liste des Paiements')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Liste des Paiements</h1>

    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b border-gray-200">ID</th>
                <th class="py-2 px-4 border-b border-gray-200">Montant</th>
                <th class="py-2 px-4 border-b border-gray-200">Méthode de Paiement</th>
                <th class="py-2 px-4 border-b border-gray-200">Statut</th>
                <th class="py-2 px-4 border-b border-gray-200">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payments as $payment)
            <tr>
                <td class="py-2 px-4 border-b border-gray-200">{{ $payment->id }}</td>
                <td class="py-2 px-4 border-b border-gray-200">{{ $payment->amount }}</td>
                <td class="py-2 px-4 border-b border-gray-200">{{ $payment->method }}</td>
                <td class="py-2 px-4 border-b border-gray-200">{{ $payment->status }}</td>
                <td class="py-2 px-4 border-b border-gray-200">
                    <a href="{{ route('payments.show', $payment->id) }}" class="text-blue-500">Voir</a> |
                    <a href="{{ route('payments.edit', $payment->id) }}" class="text-green-500">Modifier</a> |
                    <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce paiement ?');">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
