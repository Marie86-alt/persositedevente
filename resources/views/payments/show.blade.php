@extends('layouts.app')

@section('title', 'Détails du Paiement')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Détails du Paiement</h1>

    <div class="bg-white p-6 rounded shadow-md">
        <p><strong>ID :</strong> {{ $payment->id }}</p>
        <p><strong>Montant :</strong> {{ $payment->amount }}</p>
        <p><strong>Méthode de Paiement :</strong> {{ $payment->method }}</p>
        <p><strong>Statut :</strong> {{ $payment->status }}</p>
        <p><strong>Date :</strong> {{ $payment->created_at }}</p>
    </div>

    <a href="{{ route('payments.index') }}" class="inline-block mt-4 text-blue-500">Retour à la liste des paiements</a>
</div>
@endsection
ls