@php
    $stories = [
        ['name' => 'Cerita Anda', 'active' => false, 'isSelf' => true],
        ['name' => 'dian_photo...', 'active' => true],
        ['name' => 'budi_explo...', 'active' => true],
        ['name' => 'citra_art', 'active' => false],
        ['name' => 'fajar_culina...', 'active' => false],
    ];
@endphp

<div class="bg-white shadow-md border border-[#76838F]/30 rounded-2xl p-3 sm:p-5">
    <div class="flex gap-3 sm:gap-5 overflow-x-auto scrollbar-hide pb-1">
        @foreach ($stories as $story)
            <div class="flex flex-col items-center gap-1.5 sm:gap-2 shrink-0">
                <div
                    class="relative w-12 h-12 sm:w-14 sm:h-14 rounded-full p-0.5 {{ $story['active'] ?? false ? 'bg-[#76ABAE]' : 'bg-[#76838F]/20' }}">
                    <div class="w-full h-full rounded-full bg-[#ECF0F3] border-2 border-white overflow-hidden">
                        {{-- placeholder image --}}
                    </div>

                    @if ($story['isSelf'] ?? false)
                        <button type="button"
                            class="absolute bottom-0 right-0 w-4 h-4 sm:w-4.5 sm:h-4.5 bg-[#76ABAE] rounded-full flex items-center justify-center text-[9px] sm:text-[10px] text-white border-2 border-white">
                            +
                        </button>
                    @endif
                </div>
                <span
                    class="text-[11px] sm:text-xs text-[#0A2947]/60 max-w-14 sm:max-w-16 truncate">{{ $story['name'] }}</span>
            </div>
        @endforeach
    </div>
</div>
