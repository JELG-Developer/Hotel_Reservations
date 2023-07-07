<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
        .sidebar {
            margin-top: 30px;
            margin-left: 30px;
            width: 204px;
            background-color: #3182ce;
            color: #fff;
            display: flex;
            flex-direction: column;
            gap: 2px;
            padding: 8px 0;
            height: 225px ;
            border-radius: 8px;
        }

        .sidebar a {
            text-decoration: none;
            color: #fff;
            padding: 8px;
            transition: background-color 0.3s ease;
            display: flex;
            align-items: center;
        }

        .sidebar a:hover {
            background-color: #2c5282;
        }
        .title {
            text-align: center;
            font-weight: 600;
            font-size: 1.5rem;
            margin-bottom: 20px;
        }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                <div class="flex h-screen">
                {{-- Sidebar --}}
                    <div class="sidebar">
                        <a href="{{ route('admin.users.index') }}" >
                            Usuarios
                        </a>
                        <a href="{{ route('admin.categories.index') }}">
                            Categorias
                        </a>
                        <a href="{{ route('admin.rooms.index') }}">
                            Habitaciones
                        </a>
                        <a href="{{ route('admin.comments.index') }}">
                            Comentarios
                        </a>
                        <a href="{{ route('admin.bokkings.index') }}">
                            Reservaciones
                        </a>
                    </div>
                    <div class="flex-1 w-full p-8">
                        {{ $slot }}
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>

