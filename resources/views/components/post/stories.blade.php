<div class="bg-white shadow-md border border-[#76838F]/30 rounded-2xl p-3 sm:p-5">
    <div class="flex gap-3 sm:gap-5 overflow-x-auto scrollbar-hide pb-1">

        <div class="flex flex-col items-center gap-1.5 sm:gap-2 shrink-0">
            <div
                class="relative w-12 h-12 sm:w-14 sm:h-14 rounded-full p-0.5 {{ $ownHasStories ? ($ownHasUnseen ? 'bg-[#76ABAE]' : 'bg-[#76838F]/30') : 'bg-[#76838F]/20' }}">
                <button type="button"
                    onclick="{{ $ownHasStories ? "openStoryViewer('own')" : "openModal('createStoryModal')" }}"
                    class="w-full h-full rounded-full bg-[#ECF0F3] border-2 border-white overflow-hidden flex items-center justify-center font-bold text-[#76ABAE]">
                    @auth
                        @if (auth()->user()->avatar)
                            <img src="{{ Storage::url(auth()->user()->avatar) }}" class="w-full h-full object-cover">
                        @else
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        @endif
                    @endauth
                </button>

                @auth
                    <button type="button" onclick="openModal('createStoryModal')"
                        class="absolute bottom-0 right-0 w-4 h-4 sm:w-4.5 sm:h-4.5 bg-[#76ABAE] rounded-full flex items-center justify-center text-[9px] sm:text-[10px] text-white border-2 border-white">
                        +
                    </button>
                @endauth
            </div>
            <span class="text-[11px] sm:text-xs text-[#0A2947]/60 max-w-14 sm:max-w-16 truncate">Cerita Anda</span>
        </div>

        @foreach ($otherGroups as $group)
            <div class="flex flex-col items-center gap-1.5 sm:gap-2 shrink-0">
                <button type="button" onclick="openStoryViewer('{{ $group['userId'] }}')"
                    class="w-12 h-12 sm:w-14 sm:h-14 rounded-full p-0.5 {{ $group['hasUnseen'] ? 'bg-[#76ABAE]' : 'bg-[#76838F]/20' }}">
                    <div
                        class="w-full h-full rounded-full bg-[#ECF0F3] border-2 border-white overflow-hidden flex items-center justify-center font-bold text-[#76ABAE]">
                        @if ($group['avatar'])
                            <img src="{{ Storage::url($group['avatar']) }}" class="w-full h-full object-cover">
                        @else
                            {{ strtoupper(substr($group['username'], 0, 1)) }}
                        @endif
                    </div>
                </button>
                <span
                    class="text-[11px] sm:text-xs text-[#0A2947]/60 max-w-14 sm:max-w-16 truncate">{{ $group['username'] }}</span>
            </div>
        @endforeach
    </div>
</div>

<script>
    window.storyGroups = @json($storyGroupsJs);
</script>
