<div
    class="lg:hidden fixed bottom-0 left-0 right-0 z-40 bg-white border-t border-[#76838F]/30 shadow-[0_-2px_10px_rgba(0,0,0,0.05)] px-6 py-2">
    <div class="flex items-center justify-between max-w-md mx-auto">

        <button type="button" onclick="window.location.href='{{ url('/') }}'"
            class="flex flex-col items-center justify-center w-14 h-14 rounded-xl {{ request()->is('/') ? 'text-[#76ABAE]' : 'text-[#0A2947]/50' }} transition">
            <i class='bx bxs-home text-xl'></i>
        </button>

        <button type="button" onclick="window.location.href='{{ url('/explore') }}'"
            class="flex flex-col items-center justify-center w-14 h-14 rounded-xl {{ request()->is('explore') ? 'text-[#76ABAE]' : 'text-[#0A2947]/50' }} transition">
            <i class='bx bx-compass text-xl'></i>
        </button>

        <button type="button" onclick="openCreatePostModal()"
            class="flex items-center justify-center w-14 h-14 rounded-2xl bg-[#76ABAE] text-white -mt-12 shadow-lg shadow-[#76ABAE]/40">
            <i class='bx bx-plus-circle text-2xl'></i>
        </button>

        <button type="button" onclick="window.location.href='{{ url('/profile') }}'"
            class="flex flex-col items-center justify-center w-14 h-14 rounded-xl {{ request()->is('profile') ? 'text-[#76ABAE]' : 'text-[#0A2947]/50' }} transition">
            <i class='bx bx-user text-xl'></i>
        </button>

    </div>
</div>
