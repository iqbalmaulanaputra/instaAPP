<aside class="hidden lg:flex flex-col gap-4 h-fit sticky top-6">

    <div class="bg-white border border-[#76838F]/30 rounded-2xl p-4 shadow-md">
        <div class="flex items-center justify-between mb-4">
            <p class="text-md font-bold tracking-wide text-[#0A2947]/50">SARAN PENGGUNA</p>
        </div>

        @auth
            <div class="flex flex-col gap-3">
                @forelse ($suggestions as $user)
                    <div data-follow-row data-user-id="{{ $user->id }}" data-username="{{ $user->username }}"
                        data-name="{{ $user->name }}" data-avatar="{{ $user->avatar ? Storage::url($user->avatar) : '' }}"
                        class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-9 h-9 rounded-full bg-[#76ABAE] p-0.5 flex items-center justify-center font-bold text-white text-xs overflow-hidden">
                                @if ($user->avatar)
                                    <img src="{{ Storage::url($user->avatar) }}"
                                        class="w-full h-full object-cover rounded-full">
                                @else
                                    {{ strtoupper(substr($user->username, 0, 1)) }}
                                @endif
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-[#0A2947]">&#64;{{ $user->username }}</p>
                                <p class="text-xs text-[#0A2947]/50">{{ $user->name }}</p>
                            </div>
                        </div>

                        <button type="button" onclick="toggleFollow('{{ $user->id }}', this, { removeOnFollow: true })"
                            class="text-xs font-semibold text-[#76ABAE] hover:text-[#5CADB1]">Ikuti</button>
                    </div>
                @empty
                    <p class="text-xs text-[#0A2947]/40 text-center py-2">Belum ada saran pengguna baru.</p>
                @endforelse
            </div>
        @else
            <button type="button" onclick="openModal('authModal')"
                class="text-xs text-[#0A2947]/50 hover:text-[#76ABAE] transition">
                Masuk untuk melihat saran pengguna.
            </button>
        @endauth
    </div>

</aside>
