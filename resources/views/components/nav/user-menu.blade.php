@props(['variant' => 'sidebar'])

@php
    $menuId = 'userMenu-' . $variant;
@endphp

<div class="relative">
    @if ($variant === 'sidebar')
        <button type="button" onclick="toggleDropdown('{{ $menuId }}')"
            class="flex items-center gap-2 w-full bg-[#ECF0F3] hover:bg-[#e2e7ea] transition text-[#0A2947] text-sm font-medium py-2.5 px-3 rounded-xl">
            <div
                class="w-8 h-8 rounded-full bg-[#76ABAE] flex items-center justify-center overflow-hidden shrink-0 text-white font-bold text-xs">
                @if (auth()->user()->avatar)
                    <img src="{{ Storage::url(auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}"
                        class="w-full h-full object-cover">
                @else
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                @endif
            </div>
            <span class="flex-1 text-left truncate">{{ auth()->user()->name }}</span>
            <i class='bx bx-chevron-up text-lg'></i>
        </button>
    @else
        <button type="button" onclick="toggleDropdown('{{ $menuId }}')"
            class="w-9 h-9 rounded-full bg-[#76ABAE] flex items-center justify-center overflow-hidden text-white font-bold text-sm">
            @if (auth()->user()->avatar)
                <img src="{{ Storage::url(auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}"
                    class="w-full h-full object-cover">
            @else
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            @endif
        </button>
    @endif

    <div id="{{ $menuId }}"
        class="hidden absolute {{ $variant === 'sidebar' ? 'bottom-full left-0 mb-2' : 'top-full right-0 mt-2' }} w-44 bg-white border border-[#76838F]/30 shadow-lg rounded-xl overflow-hidden z-10">
        <button type="button" onclick="closeDropdown('{{ $menuId }}'); openModal('settingsModal')"
            class="w-full flex items-center gap-2 px-4 py-2.5 text-sm text-[#0A2947] hover:bg-[#ECF0F3] transition text-left">
            <i class='bx bx-cog text-base'></i> Pengaturan
        </button>
        <button type="button" onclick="logout('{{ route('logout') }}')"
            class="w-full flex items-center gap-2 px-4 py-2.5 text-sm text-rose-500 hover:bg-rose-50 transition text-left">
            <i class='bx bx-log-out text-base'></i> Keluar
        </button>
    </div>
</div>
