@extends('layouts.app')

@section('title', 'Jelajah')

@section('content')

    <form method="GET" action="{{ route('explore') }}"
        class="bg-white border border-[#76838F]/30 shadow-md rounded-2xl px-4 py-3 flex items-center gap-3">
        <i class='bx bx-search text-xl text-[#0A2947]/40'></i>
        <input type="text" name="q" value="{{ $query }}" placeholder="Cari postingan atau username..."
            class="flex-1 bg-transparent text-sm text-[#0A2947] placeholder:text-[#0A2947]/40 focus:outline-none">
        @if ($query !== '')
            <button type="button" onclick="window.location.href='{{ route('explore') }}'"
                class="text-[#0A2947]/40 hover:text-[#76ABAE] transition">
                <i class='bx bx-x text-lg'></i>
            </button>
        @endif
    </form>

    @php
        $tags = ['Semua', 'nature', 'coffeetime', 'weekend', 'architecturedesign'];
    @endphp

    <div class="flex flex-wrap gap-2">
        @foreach ($tags as $tag)
            @php
                $isActive = $tag === 'Semua' ? $query === '' : $query === $tag;
                $href = $tag === 'Semua' ? route('explore') : route('explore', ['q' => $tag]);
            @endphp
            <button type="button" onclick="window.location.href='{{ $href }}'"
                class="text-sm font-medium px-4 py-2 rounded-full transition {{ $isActive ? 'bg-[#76ABAE] text-white' : 'bg-white border border-[#76838F]/30 text-[#0A2947]/70 hover:bg-[#ECF0F3]' }}">
                {{ $tag === 'Semua' ? $tag : '#' . $tag }}
            </button>
        @endforeach
    </div>

    @if ($query !== '')
        <p class="text-sm text-[#0A2947]/50">
            Hasil pencarian untuk "<span class="font-semibold text-[#0A2947]">{{ $query }}</span>"
            ({{ $posts->count() }} postingan)
        </p>
    @endif

    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
        @forelse ($posts as $post)
            <button type="button" onclick="openModal('postDetail-{{ $post->id }}')"
                title="{{ $post->likes_count }} suka · {{ $post->comments_count }} komentar"
                class="relative group aspect-square rounded-xl overflow-hidden bg-white border border-[#76838F]/30 shadow-sm hover:shadow-md transition">
                <img src="{{ Storage::url($post->image) }}" alt="{{ $post->caption }}" class="w-full h-full object-cover">
                <div
                    class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition flex items-center justify-center gap-4 text-white opacity-0 group-hover:opacity-100">
                    <span class="flex items-center gap-1 text-sm font-semibold">
                        <i class='bx bxs-heart'></i> {{ $post->likes_count }}
                    </span>
                    <span class="flex items-center gap-1 text-sm font-semibold">
                        <i class='bx bxs-comment-detail'></i> {{ $post->comments_count }}
                    </span>
                </div>
            </button>
            <x-post.post-detail-modal :post="$post" />
        @empty
            <p class="col-span-2 sm:col-span-3 lg:col-span-4 text-center text-sm text-[#0A2947]/40 py-10">
                Tidak ada postingan yang cocok.
            </p>
        @endforelse
    </div>

@endsection
