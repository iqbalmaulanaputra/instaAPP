<div
    class="lg:hidden fixed bottom-0 left-0 right-0 z-40 bg-white border-t border-[#76838F]/30 shadow-[0_-2px_10px_rgba(0,0,0,0.05)] px-6 py-2">
    <div class="flex items-center justify-between max-w-md mx-auto">
        <x-nav.nav-link href="{{ url('/') }}" icon="bxs-home" variant="bottom" />
        <x-nav.nav-link href="{{ url('/explore') }}" icon="bx-compass" variant="bottom" />

        <button type="button" onclick="openModal('createPostModal')"
            class="flex items-center justify-center w-14 h-14 rounded-2xl bg-[#76ABAE] text-white -mt-12 shadow-lg shadow-[#76ABAE]/40">
            <i class='bx bx-plus-circle text-2xl'></i>
        </button>

        <x-nav.nav-link href="{{ url('/profile') }}" icon="bx-user" variant="bottom" :auth-required="true" />
    </div>
</div>
