@extends('layouts.app')

@section('title', 'Profil')

@section('content')
    <div class="flex items-center gap-3">
        <button type="button" onclick="window.location.href='{{ url('/') }}'"
            class="w-9 h-9 rounded-full bg-white border border-[#76838F]/30 shadow-md flex items-center justify-center text-[#0A2947] hover:bg-[#ECF0F3] transition">
            <i class='bx bx-arrow-back text-lg'></i>
        </button>
        <p class="text-sm font-semibold text-[#0A2947]">&#64;{{ auth()->user()->username }}</p>
    </div>

    <div class="bg-white border border-[#76838F]/30 shadow-md rounded-2xl p-6">
        <div class="flex items-start justify-between flex-wrap gap-4">

            <div class="flex items-center gap-4">
                <div
                    class="w-20 h-20 rounded-2xl overflow-hidden bg-[#ECF0F3] ring-2 ring-[#76ABAE] shrink-0 flex items-center justify-center font-bold text-2xl text-[#76ABAE]">
                    @if (auth()->user()->avatar)
                        <img src="{{ Storage::url(auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}"
                            class="w-full h-full object-cover">
                    @else
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    @endif
                </div>
                <div>
                    <p class="text-lg font-bold text-[#0A2947]">{{ auth()->user()->name }}</p>
                    <p class="text-sm text-[#76ABAE] font-medium">&#64;{{ auth()->user()->username }}</p>
                </div>
            </div>

            <button type="button" onclick="openModal('settingsModal')"
                class="w-10 h-10 rounded-full bg-[#ECF0F3] hover:bg-[#e2e7ea] transition text-[#0A2947] flex items-center justify-center">
                <i class='bx bx-cog text-lg'></i>
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
            {{ auth()->user()->bio ?: 'Selamat datang di InstaApp! 🚀' }}
        </p>
    </div>

    @php
        $myPosts = [1, 2, 3, 4, 5, 6];
        $savedPosts = [1, 2, 3];
    @endphp

    <div id="profileGridTabs">
        <div class="flex items-center border-b border-[#76838F]/20">
            <button type="button" data-tab-btn="posts" onclick="switchTab('posts', 'profileGridTabs')"
                class="flex-1 flex items-center justify-center gap-2 pb-3 text-sm font-semibold text-[#76ABAE] border-b-2 border-[#76ABAE]">
                <i class='bx bx-grid-alt text-lg'></i> Postingan ({{ count($myPosts) }})
            </button>
            <button type="button" data-tab-btn="saved" onclick="switchTab('saved', 'profileGridTabs')"
                class="flex-1 flex items-center justify-center gap-2 pb-3 text-sm font-semibold text-[#0A2947]/50 border-b-2 border-transparent">
                <i class='bx bx-bookmark text-lg'></i> Tersimpan ({{ count($savedPosts) }})
            </button>
        </div>

        <div data-tab-panel="posts" class="grid grid-cols-3 sm:grid-cols-4 gap-2 mt-4">
            @foreach ($myPosts as $post)
                <button type="button"
                    class="aspect-square rounded-xl overflow-hidden bg-white border border-[#76838F]/30 shadow-sm hover:shadow-md transition">

                </button>
            @endforeach
        </div>

        <div data-tab-panel="saved" class="hidden grid-cols-3 sm:grid-cols-4 gap-2 mt-4">
            @foreach ($savedPosts as $post)
                <button type="button"
                    class="aspect-square rounded-xl overflow-hidden bg-white border border-[#76838F]/30 shadow-sm hover:shadow-md transition">

                </button>
            @endforeach
        </div>
    </div>

@endsection
