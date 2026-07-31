<aside
    class="hidden lg:flex flex-col bg-white border border-[#76838F]/30 shadow-md rounded-2xl p-4 h-[calc(100vh-3rem)] sticky top-6">

    <div class="flex items-center gap-3 px-2 mb-6">
        <div class="w-9 h-9 rounded-xl bg-[#76ABAE] flex items-center justify-center font-bold text-white">
            I
        </div>
        <div>
            <p class="text-[#76ABAE] font-bold leading-tight">INSTA<span class="text-[#0A2947]">APP</span></p>
        </div>
    </div>

    <nav class="flex flex-col gap-3 text-sm">
        <x-nav.nav-link href="{{ url('/') }}" icon="bxs-home" label="Beranda" />
        <x-nav.nav-link href="{{ url('/explore') }}" icon="bx-compass" label="Jelajah" />
        <button type="button" onclick="openModal('createPostModal')"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-[#0A2947]/60 hover:bg-[#76ABAE] hover:text-white transition text-left">
            <i class='bx bx-plus-circle text-lg'></i> Buat Post
        </button>
        <x-nav.nav-link href="{{ url('/profile') }}" icon="bx-user" label="Profil Saya" />
    </nav>

    <div class="mt-auto pt-6 border-t border-[#76838F]/30">
        @auth
            <x-nav.user-menu variant="sidebar" />
        @else
            <button type="button" onclick="openModal('authModal')"
                class="flex items-center justify-center gap-2 w-full bg-[#76ABAE] hover:bg-[#5CADB1] transition text-white text-sm font-medium py-2.5 rounded-xl">
                <i class='bx bx-log-in text-lg'></i> Masuk / Daftar
            </button>
        @endauth
    </div>

</aside>
