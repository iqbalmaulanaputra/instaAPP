@extends('layouts.app')

@section('title', 'Jelajah')

@section('content')

    {{-- Search bar --}}
    <div class="bg-white border border-[#76838F]/30 shadow-md rounded-2xl px-4 py-3 flex items-center gap-3">
        <i class='bx bx-search text-xl text-[#0A2947]/40'></i>
        <input type="text" placeholder="Cari postingan, username, hashtag, atau lokasi..."
            class="flex-1 bg-transparent text-sm text-[#0A2947] placeholder:text-[#0A2947]/40 focus:outline-none">
    </div>

    {{-- Filter tags --}}
    @php
        $tags = ['Semua', '#nature', '#coffeetime', 'Jakarta', 'Yogyakarta', 'Estetik'];
        $active = 'Semua';
    @endphp

    <div class="flex flex-wrap gap-2">
        @foreach ($tags as $tag)
            <button type="button"
                class="text-sm font-medium px-4 py-2 rounded-full transition {{ $tag === $active ? 'bg-[#76ABAE] text-white' : 'bg-white border border-[#76838F]/30 text-[#0A2947]/70 hover:bg-[#ECF0F3]' }}">
                {{ $tag }}
            </button>
        @endforeach
    </div>

    {{-- Grid postingan --}}
    @php
        $explorePosts = [1, 2, 3, 4, 5, 6, 7, 8, 9];
    @endphp

    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
        @foreach ($explorePosts as $post)
            <button type="button"
                class="aspect-square rounded-xl overflow-hidden bg-white border border-[#76838F]/30 shadow-sm hover:shadow-md transition">
                {{-- gambar post nanti masuk di sini --}}
            </button>
        @endforeach
    </div>

@endsection
