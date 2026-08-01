@props(['followers', 'following'])

<div id="followListModal" class="hidden fixed inset-0 z-50 items-center justify-center bg-black/50 backdrop-blur-sm px-4">
    <div class="bg-white w-full max-w-md rounded-2xl overflow-hidden shadow-xl max-h-[80vh] flex flex-col">

        <div class="relative flex items-center justify-center border-b border-[#76838F]/20 px-6 py-4 shrink-0">
            <button type="button" onclick="closeModal('followListModal')"
                class="absolute left-4 w-8 h-8 rounded-full hover:bg-[#ECF0F3] transition flex items-center justify-center text-[#0A2947]">
                <i class='bx bx-x text-lg'></i>
            </button>
            <p class="text-sm font-semibold text-[#0A2947]">Koneksi</p>
        </div>

        <div id="followListTabs" class="flex flex-col overflow-hidden flex-1">
            <div class="flex border-b border-[#76838F]/20 shrink-0">
                <button type="button" data-tab-btn="followers" onclick="switchTab('followers', 'followListTabs')"
                    class="flex-1 py-3 text-sm font-semibold text-[#76ABAE] border-b-2 border-[#76ABAE]">
                    Pengikut ({{ $followers->count() }})
                </button>
                <button type="button" data-tab-btn="following" onclick="switchTab('following', 'followListTabs')"
                    class="flex-1 py-3 text-sm font-semibold text-[#0A2947]/50 border-b-2 border-transparent">
                    Mengikuti ({{ $following->count() }})
                </button>
            </div>

            <div class="overflow-y-auto scrollbar-hide flex-1">

                <div data-tab-panel="followers" class="flex flex-col divide-y divide-[#76838F]/10">
                    @forelse ($followers as $person)
                        <div data-follow-row data-user-id="{{ $person->id }}" data-username="{{ $person->username }}"
                            data-name="{{ $person->name }}"
                            data-avatar="{{ $person->avatar ? Storage::url($person->avatar) : '' }}"
                            class="flex items-center justify-between px-4 py-3">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-9 h-9 rounded-full bg-[#ECF0F3] overflow-hidden shrink-0 flex items-center justify-center font-bold text-[#76ABAE] text-sm">
                                    @if ($person->avatar)
                                        <img src="{{ Storage::url($person->avatar) }}"
                                            class="w-full h-full object-cover">
                                    @else
                                        {{ strtoupper(substr($person->username, 0, 1)) }}
                                    @endif
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-[#0A2947]">&#64;{{ $person->username }}</p>
                                    <p class="text-xs text-[#0A2947]/50">{{ $person->name }}</p>
                                </div>
                            </div>
                            <button type="button" onclick="toggleFollow('{{ $person->id }}', this)"
                                class="text-xs font-semibold {{ auth()->user()->isFollowing($person->id) ? 'text-[#0A2947]/50' : 'text-[#76ABAE] hover:text-[#5CADB1]' }}">
                                {{ auth()->user()->isFollowing($person->id) ? 'Mengikuti' : 'Ikuti' }}
                            </button>
                        </div>
                    @empty
                        <p data-empty-message class="text-center text-sm text-[#0A2947]/40 py-6">Belum ada pengikut.</p>
                    @endforelse
                </div>

                <div data-tab-panel="following" class="hidden flex-col divide-y divide-[#76838F]/10">
                    @forelse ($following as $person)
                        <div data-follow-row data-user-id="{{ $person->id }}"
                            data-username="{{ $person->username }}" data-name="{{ $person->name }}"
                            data-avatar="{{ $person->avatar ? Storage::url($person->avatar) : '' }}"
                            class="flex items-center justify-between px-4 py-3">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-9 h-9 rounded-full bg-[#ECF0F3] overflow-hidden shrink-0 flex items-center justify-center font-bold text-[#76ABAE] text-sm">
                                    @if ($person->avatar)
                                        <img src="{{ Storage::url($person->avatar) }}"
                                            class="w-full h-full object-cover">
                                    @else
                                        {{ strtoupper(substr($person->username, 0, 1)) }}
                                    @endif
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-[#0A2947]">&#64;{{ $person->username }}</p>
                                    <p class="text-xs text-[#0A2947]/50">{{ $person->name }}</p>
                                </div>
                            </div>
                            <button type="button"
                                onclick="toggleFollow('{{ $person->id }}', this, { removeOnUnfollow: true })"
                                class="text-xs font-semibold text-[#0A2947]/50">
                                Mengikuti
                            </button>
                        </div>
                    @empty
                        <p data-empty-message class="text-center text-sm text-[#0A2947]/40 py-6">Belum mengikuti siapa
                            pun.</p>
                    @endforelse
                </div>

            </div>
        </div>

    </div>
</div>
