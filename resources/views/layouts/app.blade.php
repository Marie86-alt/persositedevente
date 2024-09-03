<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Site de Vente de Fruits et Légumes')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>

   
</head>
<body class="bg-gray-100">
@include('layouts.navbar')

    <div class="container mx-auto mt-8">
        @yield('content')
    </div>
    @include('layouts.footer')
    <script src="node_modules/@material-tailwind/html/scripts/collapse.js"></script>

<script src="https://unpkg.com/@material-tailwind/html@latest/scripts/collapse.js"></script>
</body>
</html>
