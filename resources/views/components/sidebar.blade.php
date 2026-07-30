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
        <button type="button" onclick="window.location.href='{{ url('/') }}'"
            class="flex items-center gap-3 px-3 py-3 rounded-xl {{ request()->is('/') ? 'bg-[#76ABAE] text-white' : 'text-[#0A2947]/60 hover:bg-[#76ABAE] hover:text-white' }} font-medium transition text-left">
            <i class='bx bxs-home text-lg'></i> Beranda
        </button>
        <button type="button" onclick="window.location.href='{{ url('/explore') }}'"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl {{ request()->is('explore') ? 'bg-[#76ABAE] text-white' : 'text-[#0A2947]/60 hover:bg-[#76ABAE] hover:text-white' }} font-medium transition text-left">
            <i class='bx bx-compass text-lg'></i> Jelajah
        </button>
        <button type="button" onclick="openCreatePostModal()"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-[#0A2947]/60 hover:bg-[#76ABAE] hover:text-white transition text-left">
            <i class='bx bx-plus-circle text-lg'></i> Buat Post
        </button>
        <button type="button" onclick="window.location.href='{{ url('/profile') }}'"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl {{ request()->is('profile') ? 'bg-[#76ABAE] text-white' : 'text-[#0A2947]/60 hover:bg-[#76ABAE] hover:text-white' }} font-medium transition text-left">
            <i class='bx bx-user text-lg'></i> Profil Saya
        </button>
    </nav>

    <div class="mt-auto pt-6 border-t border-[#76838F]/30">
        <button type="button" onclick="openAuthModal()"
            class="flex items-center justify-center gap-2 w-full bg-[#76ABAE] hover:bg-[#5CADB1] transition text-white text-sm font-medium py-2.5 rounded-xl">
            <i class='bx bx-log-in text-lg'></i> Masuk / Daftar
        </button>
    </div>

</aside>
