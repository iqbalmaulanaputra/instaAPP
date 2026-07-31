@extends('layouts.app')

@section('title', 'Profil')

@section('content')
    <div class="flex items-center gap-3">
        <button type="button"
            class="w-9 h-9 rounded-full bg-white border border-[#76838F]/30 shadow-md flex items-center justify-center text-[#0A2947] hover:bg-[#ECF0F3] transition">
            <i class='bx bx-arrow-back text-lg'></i>
        </button>
        <p class="text-sm font-semibold text-[#0A2947]">&#64;demouser</p>
    </div>

    <div class="bg-white border border-[#76838F]/30 shadow-md rounded-2xl p-6">
        <div class="flex items-start justify-between flex-wrap gap-4">

            <div class="flex items-center gap-4">
                <div class="w-20 h-20 rounded-2xl overflow-hidden bg-[#ECF0F3] ring-2 ring-[#76ABAE] shrink-0">
                    {{-- foto profil nanti masuk di sini --}}
                </div>
                <div>
                    <p class="text-lg font-bold text-[#0A2947]">Demo User</p>
                    <p class="text-sm text-[#76ABAE] font-medium">&#64;demouser</p>
                </div>
            </div>

            <button type="button"
                class="bg-[#ECF0F3] hover:bg-[#e2e7ea] transition text-[#0A2947] text-sm font-medium px-4 py-2 rounded-full">
                Profil Anda
            </button>
        </div>

        <div class="grid grid-cols-3 gap-3 mt-5">
            <div class="bg-[#ECF0F3] rounded-xl py-3 text-center">
                <p class="text-lg font-bold text-[#0A2947]">6</p>
                <p class="text-xs text-[#0A2947]/50">Postingan</p>
            </div>
            <div class="bg-[#ECF0F3] rounded-xl py-3 text-center">
                <p class="text-lg font-bold text-[#0A2947]">150</p>
                <p class="text-xs text-[#0A2947]/50">Pengikut</p>
            </div>
            <div class="bg-[#ECF0F3] rounded-xl py-3 text-center">
                <p class="text-lg font-bold text-[#0A2947]">95</p>
                <p class="text-xs text-[#0A2947]/50">Mengikuti</p>
            </div>
        </div>

        <p class="text-sm text-[#0A2947]/70 mt-5">
            Selamat datang di InstaApp! 🚀
        </p>
    </div>

    @php
        $myPosts = [1, 2, 3, 4, 5, 6];
    @endphp

    <div>
        <div class="flex items-center justify-center gap-2 pb-3 border-b border-[#76838F]/20">
            <i class='bx bx-grid-alt text-[#76ABAE] text-lg'></i>
            <p class="text-sm font-semibold text-[#76ABAE]">Postingan ({{ count($myPosts) }})</p>
        </div>

        <div class="grid grid-cols-3 sm:grid-cols-4 gap-2 mt-4">
            @foreach ($myPosts as $post)
                <button type="button"
                    class="aspect-square rounded-xl overflow-hidden bg-white border border-[#76838F]/30 shadow-sm hover:shadow-md transition">
                    {{-- thumbnail post nanti masuk di sini --}}
                </button>
            @endforeach
        </div>
    </div>

@endsection
