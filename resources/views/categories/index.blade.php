@extends('layouts.app')

@section('title', 'Liste des Catégories')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Liste des Catégories</h1>

    <a href="{{ route('categories.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Ajouter une catégorie</a>

    <table class="min-w-full bg-white mt-4">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="w-3/4 px-4 py-2">Nom</th>
                <th class="w-1/4 px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr class="text-center">
                <td class="border px-4 py-2">{{ $category->name }}</td>
                <td class="border px-4 py-2">
                    <a href="{{ route('categories.show', $category->id) }}" class="text-blue-500">Voir</a>
                    <a href="{{ route('categories.edit', $category->id) }}" class="text-yellow-500 ml-2">Modifier</a>
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline-block ml-2">
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
