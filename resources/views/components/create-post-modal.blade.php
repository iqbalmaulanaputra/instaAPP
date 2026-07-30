<div id="createPostModal" class="hidden fixed inset-0 z-50 items-center justify-center bg-black/50 backdrop-blur-sm px-4">
    <div class="bg-white w-full max-w-md rounded-2xl overflow-hidden shadow-xl max-h-[90vh] flex flex-col">

        {{-- Header --}}
        <div class="relative bg-[#76ABAE] px-6 py-5 flex items-center justify-center shrink-0">
            <button type="button" onclick="closeCreatePostModal()"
                class="absolute left-4 top-1/2 -translate-y-1/2 w-8 h-8 rounded-full bg-white/20 hover:bg-white/30 transition flex items-center justify-center text-white">
                <i class='bx bx-x text-lg'></i>
            </button>
            <p class="text-white font-bold text-base">Buat Postingan Baru</p>
        </div>

        {{-- Form --}}
        <div class="overflow-y-auto p-6 flex flex-col gap-4">

            {{-- Upload area --}}
            <div
                class="aspect-square rounded-xl border-2 border-dashed border-[#76838F]/40 bg-[#ECF0F3] flex flex-col items-center justify-center gap-2 text-[#0A2947]/50 cursor-pointer hover:bg-[#e2e7ea] transition">
                <i class='bx bx-image-add text-3xl'></i>
                <p class="text-sm">Klik untuk pilih foto</p>
            </div>

            <div>
                <label class="text-sm font-medium text-[#0A2947]">Caption</label>
                <textarea rows="3" placeholder="Tulis caption untuk postinganmu..."
                    class="w-full bg-[#ECF0F3] rounded-xl px-4 py-3 mt-1.5 text-sm text-[#0A2947] placeholder:text-[#0A2947]/40 focus:outline-none resize-none"></textarea>
            </div>

            <div>
                <label class="text-sm font-medium text-[#0A2947]">Lokasi (opsional)</label>
                <div class="flex items-center gap-2 bg-[#ECF0F3] rounded-xl px-4 py-3 mt-1.5">
                    <i class='bx bx-map text-[#0A2947]/40'></i>
                    <input type="text" placeholder="misal: Bandung, Jawa Barat"
                        class="flex-1 bg-transparent text-sm text-[#0A2947] placeholder:text-[#0A2947]/40 focus:outline-none">
                </div>
            </div>

            <button type="button"
                class="w-full bg-[#76ABAE] hover:bg-[#5CADB1] transition text-white text-sm font-semibold py-3 rounded-xl mt-2">
                Bagikan Postingan
            </button>
        </div>

    </div>
</div>

<script>
    function openCreatePostModal() {
        const modal = document.getElementById('createPostModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.classList.add('overflow-hidden');
    }

    function closeCreatePostModal() {
        const modal = document.getElementById('createPostModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.classList.remove('overflow-hidden');
    }
</script>
