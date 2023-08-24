@props(['title', 'description', 'imageUrl'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <x-meta :title="$title" description="test" />
    <title>{{ $title }}</title>

    @vite(['resources/js/app.js', 'resources/css/app.css'])

    {{ $head ?? '' }}

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
</head>

<body class="antialiased">
    <x-header />
    <main class="max-w-6xl mx-auto">
        {{ $slot }}
    </main>
    <x-footer />
</body>

</html>
