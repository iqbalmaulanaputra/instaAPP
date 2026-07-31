<div id="settingsModal" class="hidden fixed inset-0 z-50 items-center justify-center bg-black/50 backdrop-blur-sm px-4">
    <div class="bg-white w-full max-w-md rounded-2xl overflow-hidden shadow-xl max-h-[90vh] flex flex-col">

        <div class="relative flex items-center justify-center border-b border-[#76838F]/20 px-6 py-4 shrink-0">
            <button type="button" onclick="closeModal('settingsModal')"
                class="absolute left-4 w-8 h-8 rounded-full hover:bg-[#ECF0F3] transition flex items-center justify-center text-[#0A2947]">
                <i class='bx bx-x text-lg'></i>
            </button>
            <p class="text-sm font-semibold text-[#0A2947]">Pengaturan Akun</p>
        </div>

        <div id="settingsTabs" class="flex flex-col overflow-hidden flex-1">
            <div class="flex border-b border-[#76838F]/20 shrink-0">
                <button type="button" data-tab-btn="edit" onclick="switchTab('edit', 'settingsTabs')"
                    class="flex-1 py-3 text-sm font-semibold text-[#76ABAE] border-b-2 border-[#76ABAE]">
                    Edit Profil
                </button>
                <button type="button" data-tab-btn="password" onclick="switchTab('password', 'settingsTabs')"
                    class="flex-1 py-3 text-sm font-semibold text-[#0A2947]/50 border-b-2 border-transparent">
                    Kata Sandi
                </button>
            </div>

            <div class="overflow-y-auto scrollbar-hide">

                <div data-tab-panel="edit" class="p-6 flex flex-col gap-4">

                    <div id="profileError"
                        class="hidden bg-rose-50 border border-rose-200 text-rose-600 text-sm px-4 py-3 rounded-xl">
                    </div>

                    <div class="flex items-center gap-4">
                        <div id="profileAvatarPreview"
                            class="w-16 h-16 rounded-2xl bg-[#ECF0F3] overflow-hidden shrink-0 flex items-center justify-center font-bold text-xl text-[#76ABAE]">
                            @if (auth()->user()->avatar)
                                <img src="{{ Storage::url(auth()->user()->avatar) }}" alt="avatar"
                                    class="w-full h-full object-cover">
                            @else
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            @endif
                        </div>
                        <label
                            class="text-sm font-medium text-[#76ABAE] hover:text-[#5CADB1] cursor-pointer transition">
                            Ganti Foto
                            <input type="file" id="profileAvatarInput" accept="image/*"
                                onchange="previewAvatar(this)" class="hidden">
                        </label>
                    </div>

                    <div>
                        <label class="text-sm font-medium text-[#0A2947]">Nama Lengkap</label>
                        <div class="flex items-center gap-2 bg-[#ECF0F3] rounded-xl px-4 py-3 mt-1.5">
                            <i class='bx bx-id-card text-[#0A2947]/40'></i>
                            <input type="text" id="profileName" value="{{ auth()->user()->name }}"
                                class="flex-1 bg-transparent text-sm text-[#0A2947] focus:outline-none">
                        </div>
                    </div>

                    <div>
                        <label class="text-sm font-medium text-[#0A2947]">Username</label>
                        <div class="flex items-center gap-2 bg-[#ECF0F3] rounded-xl px-4 py-3 mt-1.5">
                            <i class='bx bx-at text-[#0A2947]/40'></i>
                            <input type="text" id="profileUsername" value="{{ auth()->user()->username }}"
                                class="flex-1 bg-transparent text-sm text-[#0A2947] focus:outline-none">
                        </div>
                    </div>

                    <div>
                        <label class="text-sm font-medium text-[#0A2947]">Email</label>
                        <div class="flex items-center gap-2 bg-[#ECF0F3] rounded-xl px-4 py-3 mt-1.5">
                            <i class='bx bx-envelope text-[#0A2947]/40'></i>
                            <input type="email" id="profileEmail" value="{{ auth()->user()->email }}"
                                class="flex-1 bg-transparent text-sm text-[#0A2947] focus:outline-none">
                        </div>
                    </div>

                    <div>
                        <label class="text-sm font-medium text-[#0A2947]">Bio</label>
                        <textarea rows="3" id="profileBio"
                            class="w-full bg-[#ECF0F3] rounded-xl px-4 py-3 mt-1.5 text-sm text-[#0A2947] focus:outline-none resize-none">{{ auth()->user()->bio }}</textarea>
                    </div>

                    <button type="button" onclick="submitProfileUpdate('{{ route('profile.update') }}')"
                        class="w-full bg-[#76ABAE] hover:bg-[#5CADB1] transition text-white text-sm font-semibold py-3 rounded-xl mt-2">
                        Simpan Perubahan
                    </button>
                </div>

                <div data-tab-panel="password" class="hidden p-6 flex-col gap-4">

                    <div id="passwordError"
                        class="hidden bg-rose-50 border border-rose-200 text-rose-600 text-sm px-4 py-3 rounded-xl">
                    </div>

                    <div>
                        <label class="text-sm font-medium text-[#0A2947]">Kata Sandi Saat Ini</label>
                        <div class="flex items-center gap-2 bg-[#ECF0F3] rounded-xl px-4 py-3 mt-1.5">
                            <i class='bx bx-lock-alt text-[#0A2947]/40'></i>
                            <input type="password" id="currentPassword" placeholder="••••••••"
                                class="flex-1 bg-transparent text-sm text-[#0A2947] placeholder:text-[#0A2947]/40 focus:outline-none">
                        </div>
                    </div>

                    <div>
                        <label class="text-sm font-medium text-[#0A2947]">Kata Sandi Baru</label>
                        <div class="flex items-center gap-2 bg-[#ECF0F3] rounded-xl px-4 py-3 mt-1.5">
                            <i class='bx bx-lock-alt text-[#0A2947]/40'></i>
                            <input type="password" id="newPassword" placeholder="••••••••"
                                class="flex-1 bg-transparent text-sm text-[#0A2947] placeholder:text-[#0A2947]/40 focus:outline-none">
                        </div>
                    </div>

                    <div>
                        <label class="text-sm font-medium text-[#0A2947]">Konfirmasi Kata Sandi Baru</label>
                        <div class="flex items-center gap-2 bg-[#ECF0F3] rounded-xl px-4 py-3 mt-1.5">
                            <i class='bx bx-lock-alt text-[#0A2947]/40'></i>
                            <input type="password" id="newPasswordConfirmation" placeholder="••••••••"
                                class="flex-1 bg-transparent text-sm text-[#0A2947] placeholder:text-[#0A2947]/40 focus:outline-none">
                        </div>
                    </div>

                    <button type="button" onclick="submitPasswordUpdate('{{ route('profile.password.update') }}')"
                        class="w-full bg-[#76ABAE] hover:bg-[#5CADB1] transition text-white text-sm font-semibold py-3 rounded-xl mt-2">
                        Perbarui Kata Sandi
                    </button>
                </div>

            </div>
        </div>

    </div>
</div>
