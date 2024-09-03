@extends('layouts.app')

@section('title', 'Détails de l\'Utilisateur')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Détails de l'Utilisateur</h1>

    <div class="bg-white p-6 rounded shadow-md">
        <p><strong>ID :</strong> {{ $user->id }}</p>
        <p><strong>Nom :</strong> {{ $user->name }}</p>
        <p><strong>Email :</strong> {{ $user->email }}</p>
        <p><strong>Date de Création :</strong> {{ $user->created_at }}</p>
        <p><strong>Dernière Mise à Jour :</strong> {{ $user->updated_at }}</p>
    </div>

    <a href="{{ route('users.index') }}" class="inline-block mt-4 text-blue-500">Retour à la liste des utilisateurs</a>
</div>
@endsection
