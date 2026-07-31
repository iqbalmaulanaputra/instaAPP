<div id="authModal" class="hidden fixed inset-0 z-50 items-center justify-center bg-black/50 backdrop-blur-sm px-4">
    <div class="bg-white w-full max-w-md rounded-2xl overflow-hidden shadow-xl max-h-[90vh] flex flex-col">
        <div class="relative bg-[#76ABAE] px-6 py-8 text-center shrink-0">
            <button type="button" onclick="closeModal('authModal')"
                class="absolute top-4 right-4 w-8 h-8 rounded-full bg-white/20 hover:bg-white/30 transition flex items-center justify-center text-white">
                <i class='bx bx-x text-lg'></i>
            </button>

            <div
                class="w-14 h-14 mx-auto rounded-2xl bg-white/20 flex items-center justify-center font-bold text-2xl text-white mb-3">
                I
            </div>
            <p class="text-white font-bold text-xl">
                INSTA<span class="text-[#0A2947]">APP</span>
            </p>
            <p class="text-white/80 text-sm mt-1">Autentikasi Pengguna &amp; Akses Komunitas</p>
        </div>

        <div class="flex border-b border-[#76838F]/20 shrink-0">
            <button type="button" id="tabLoginBtn" onclick="switchAuthTab('login')"
                class="flex-1 py-3 text-sm font-semibold text-[#76ABAE] border-b-2 border-[#76ABAE]">
                Masuk
            </button>
            <button type="button" id="tabRegisterBtn" onclick="switchAuthTab('register')"
                class="flex-1 py-3 text-sm font-semibold text-[#0A2947]/50 border-b-2 border-transparent">
                Daftar Akun Baru
            </button>
        </div>

        <div class="overflow-y-auto scrollbar-hide">
            <div id="loginPanel" class="p-6 flex flex-col gap-4">
                <div>
                    <label class="text-sm font-medium text-[#0A2947]">Username atau Email</label>
                    <div class="flex items-center gap-2 bg-[#ECF0F3] rounded-xl px-4 py-3 mt-1.5">
                        <i class='bx bx-user text-[#0A2947]/40'></i>
                        <input type="text" placeholder="misal: demouser"
                            class="flex-1 bg-transparent text-sm text-[#0A2947] placeholder:text-[#0A2947]/40 focus:outline-none">
                    </div>
                </div>

                <div>
                    <label class="text-sm font-medium text-[#0A2947]">Kata Sandi</label>
                    <div class="flex items-center gap-2 bg-[#ECF0F3] rounded-xl px-4 py-3 mt-1.5">
                        <i class='bx bx-lock-alt text-[#0A2947]/40'></i>
                        <input type="password" placeholder="••••••••"
                            class="flex-1 bg-transparent text-sm text-[#0A2947] placeholder:text-[#0A2947]/40 focus:outline-none">
                    </div>
                </div>

                <button type="button"
                    class="w-full bg-[#76ABAE] hover:bg-[#5CADB1] transition text-white text-sm font-semibold py-3 rounded-xl mt-2">
                    Masuk ke InstaApp
                </button>
            </div>

            <div id="registerPanel" class="hidden p-6 flex-col gap-4 ">
                <div>
                    <label class="text-sm font-medium text-[#0A2947]">Nama Lengkap</label>
                    <div class="flex items-center gap-2 bg-[#ECF0F3] rounded-xl px-4 py-3 mt-1.5">
                        <i class='bx bx-id-card text-[#0A2947]/40'></i>
                        <input type="text" placeholder="misal: Demo User"
                            class="flex-1 bg-transparent text-sm text-[#0A2947] placeholder:text-[#0A2947]/40 focus:outline-none">
                    </div>
                </div>

                <div>
                    <label class="text-sm font-medium text-[#0A2947]">Username</label>
                    <div class="flex items-center gap-2 bg-[#ECF0F3] rounded-xl px-4 py-3 mt-1.5">
                        <i class='bx bx-at text-[#0A2947]/40'></i>
                        <input type="text" placeholder="misal: demouser"
                            class="flex-1 bg-transparent text-sm text-[#0A2947] placeholder:text-[#0A2947]/40 focus:outline-none">
                    </div>
                </div>

                <div>
                    <label class="text-sm font-medium text-[#0A2947]">Email</label>
                    <div class="flex items-center gap-2 bg-[#ECF0F3] rounded-xl px-4 py-3 mt-1.5">
                        <i class='bx bx-envelope text-[#0A2947]/40'></i>
                        <input type="email" placeholder="misal: demo@mail.com"
                            class="flex-1 bg-transparent text-sm text-[#0A2947] placeholder:text-[#0A2947]/40 focus:outline-none">
                    </div>
                </div>

                <div>
                    <label class="text-sm font-medium text-[#0A2947]">Kata Sandi</label>
                    <div class="flex items-center gap-2 bg-[#ECF0F3] rounded-xl px-4 py-3 mt-1.5">
                        <i class='bx bx-lock-alt text-[#0A2947]/40'></i>
                        <input type="password" placeholder="••••••••"
                            class="flex-1 bg-transparent text-sm text-[#0A2947] placeholder:text-[#0A2947]/40 focus:outline-none">
                    </div>
                </div>

                <button type="button"
                    class="w-full bg-[#76ABAE] hover:bg-[#5CADB1] transition text-white text-sm font-semibold py-3 rounded-xl mt-2">
                    Daftar Sekarang
                </button>
            </div>

        </div>

    </div>
</div>
