<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'InstaApp') }} - @yield('title', 'Beranda')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#ECF0F3] text-[#0A2947] min-h-screen pb-20 lg:pb-0">

    <div class="max-w-350 mx-auto grid grid-cols-1 lg:grid-cols-[256px_1fr_300px] gap-6 px-6 py-6">

        <x-sidebar />

        <main class="flex flex-col gap-6 bg-transparent">
            <x-mobile-topbar />

            @yield('content')
        </main>

        <x-suggestions />

    </div>

    <x-mobile-bottom-nav />

    <x-auth-modal />

</body>

</html>
