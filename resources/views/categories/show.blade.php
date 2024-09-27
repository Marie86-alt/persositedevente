@extends('layouts.app')

@section('title', 'Détails de la Catégorie')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">{{ $category->name }}</h1>

    <a href="{{ route('categories.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Retour à la liste</a>
</div>
@endsection
