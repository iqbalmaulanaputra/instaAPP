@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

    <x-post.stories />

    @forelse ($posts as $post)
        <x-post.post-card :post="$post" />
    @empty
        <div class="bg-white border border-[#76838F]/30 shadow-md rounded-2xl p-8 text-center text-sm text-[#0A2947]/50">
            Belum ada postingan. Yuk bagikan momenmu!
        </div>
    @endforelse

@endsection
