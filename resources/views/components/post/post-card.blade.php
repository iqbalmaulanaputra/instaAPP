@props([
    'username' => 'username',
    'location' => '',
    'filter' => null,
    'likes' => 0,
    'caption' => '',
    'date' => '',
])

<div class="bg-white border border-[#76838F]/30 shadow-md rounded-2xl overflow-hidden">
    <div class="flex items-center justify-between px-4 py-3">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-full overflow-hidden bg-[#ECF0F3] shrink-0">

            </div>
            <div>
                <p class="text-sm font-semibold text-[#0A2947]">&#64;{{ $username }}</p>
                @if ($location)
                    <p class="text-xs text-[#0A2947]/50">{{ $location }}</p>
                @endif
            </div>
        </div>

        <button type="button" class="text-[#0A2947]/50 hover:text-[#76ABAE] transition text-lg">
            <i class='bx bx-dots-vertical-rounded'></i>
        </button>
    </div>

    <div class="relative w-full aspect-square bg-[#ECF0F3]">
        {{ $slot }}

        @if ($filter)
            <span
                class="absolute top-3 right-3 text-[10px] font-semibold tracking-wider bg-black/60 text-white px-3 py-1 rounded-full uppercase">
                {{ $filter }}
            </span>
        @endif
    </div>

    <div class="flex items-center justify-between px-4 pt-3 text-2xl text-[#0A2947]/70">
        <div class="flex items-center gap-4">
            <button type="button" class="hover:text-rose-500 transition">
                <i class='bx bx-heart'></i>
            </button>
            <button type="button" class="hover:text-[#76ABAE] transition">
                <i class='bx bx-comment'></i>
            </button>
            <button type="button" class="hover:text-[#76ABAE] transition">
                <i class='bx bx-send'></i>
            </button>
        </div>

        <button type="button" class="hover:text-[#76ABAE] transition">
            <i class='bx bx-bookmark'></i>
        </button>
    </div>

    @if ($likes > 0)
        <p class="px-4 pt-2 text-sm font-semibold text-[#0A2947]">{{ $likes }} menyukai ini</p>
    @endif

    @if ($caption)
        <p class="px-4 pt-1 text-sm text-[#0A2947]/80">
            <span class="font-semibold text-[#0A2947]">&#64;{{ $username }}</span>
            {{ $caption }}
        </p>
    @endif

    @if ($date)
        <p class="px-4 pt-2 pb-4 text-[11px] text-[#0A2947]/40 uppercase tracking-wide">{{ $date }}</p>
    @endif

    <div class="flex items-center gap-2 px-4 py-3 border-t border-[#76838F]/30">
        <input type="text" placeholder="Masuk untuk memberi komentar..." disabled
            class="flex-1 text-sm text-[#0A2947]/60 placeholder:text-[#0A2947]/40 focus:outline-none disabled:cursor-not-allowed">
        <button type="button"
            class="w-8 h-8 rounded-full bg-[#76ABAE]/15 text-[#76ABAE] flex items-center justify-center hover:bg-[#76ABAE]/25 transition">
            <i class='bx bx-send text-base'></i>
        </button>
    </div>

</div>
