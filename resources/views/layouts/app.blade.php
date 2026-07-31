<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'InstaApp') }} - @yield('title', 'Beranda')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body data-flash-success="{{ session('success') }}" class="bg-[#ECF0F3] text-[#0A2947] min-h-screen pb-20 lg:pb-0">

    <div class="max-w-350 mx-auto grid grid-cols-1 lg:grid-cols-[256px_1fr_300px] gap-6 px-6 py-6">

        <x-layout.sidebar />

        <main class="flex flex-col gap-6 bg-transparent">
            <x-layout.mobile-topbar />
            @yield('content')
        </main>

        <x-suggestions />

    </div>

    <x-layout.mobile-bottom-nav />

    <x-modal.auth-modal />
    <x-modal.create-post-modal />

    @auth
        <x-modal.settings-modal />
    @endauth

</body>

</html>
