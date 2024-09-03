@extends('layouts.app')

@section('title', 'Liste des Utilisateurs')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Liste des Utilisateurs</h1>

    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b border-gray-200">ID</th>
                <th class="py-2 px-4 border-b border-gray-200">Nom</th>
                <th class="py-2 px-4 border-b border-gray-200">Email</th>
                <th class="py-2 px-4 border-b border-gray-200">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td class="py-2 px-4 border-b border-gray-200">{{ $user->id }}</td>
                <td class="py-2 px-4 border-b border-gray-200">{{ $user->name }}</td>
                <td class="py-2 px-4 border-b border-gray-200">{{ $user->email }}</td>
                <td class="py-2 px-4 border-b border-gray-200">
                    <a href="{{ route('users.show', $user->id) }}" class="text-blue-500">Voir</a> |
                    <a href="{{ route('users.edit', $user->id) }}" class="text-green-500">Modifier</a> |
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
