@extends('layouts.app')

@section('title', 'Modifier un Paiement')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Modifier un Paiement</h1>

    <form action="{{ route('payments.update', $payment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="amount" class="block text-gray-700 text-sm font-bold mb-2">Montant :</label>
            <input type="text" name="amount" id="amount" value="{{ old('amount', $payment->amount) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="mb-4">
            <label for="method" class="block text-gray-700 text-sm font-bold mb-2">Méthode de Paiement :</label>
            <input type="text" name="method" id="method" value="{{ old('method', $payment->method) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="mb-4">
            <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Statut :</label>
            <input type="text" name="status" id="status" value="{{ old('status', $payment->status) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Modifier
            </button>
            <a href="{{ route('payments.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                Annuler
            </a>
        </div>
    </form>
</div>
@endsection
