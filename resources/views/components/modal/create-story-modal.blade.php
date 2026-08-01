<div id="createStoryModal"
    class="hidden fixed inset-0 z-50 items-center justify-center bg-black/50 backdrop-blur-sm px-4">
    <div class="bg-white w-full max-w-md rounded-2xl overflow-hidden shadow-xl max-h-[90vh] flex flex-col">
        <div class="relative bg-[#76ABAE] px-6 py-5 flex items-center justify-center shrink-0">
            <button type="button" onclick="closeModal('createStoryModal')"
                class="absolute left-4 top-1/2 -translate-y-1/2 w-8 h-8 rounded-full bg-white/20 hover:bg-white/30 transition flex items-center justify-center text-white">
                <i class='bx bx-x text-lg'></i>
            </button>
            <p class="text-white font-bold text-base">Buat Story Baru</p>
        </div>

        <div class="overflow-y-auto scrollbar-hide p-6 flex flex-col gap-4">

            <div id="createStoryError"
                class="hidden bg-rose-50 border border-rose-200 text-rose-600 text-sm px-4 py-3 rounded-xl">
            </div>

            <button type="button" onclick="document.getElementById('createStoryImageInput').click()"
                class="aspect-9/16 rounded-xl border-2 border-dashed border-[#76838F]/40 bg-[#ECF0F3] overflow-hidden flex flex-col items-center justify-center gap-2 text-[#0A2947]/50 cursor-pointer hover:bg-[#e2e7ea] transition">
                <div id="createStoryImagePreview" class="w-full h-full flex flex-col items-center justify-center gap-2">
                    <i class='bx bx-image-add text-3xl'></i>
                    <p class="text-sm">Klik untuk pilih foto story</p>
                </div>
            </button>
            <input type="file" id="createStoryImageInput" accept="image/*" onchange="previewStoryImage(this)"
                class="hidden">

            <p class="text-xs text-[#0A2947]/40 text-center">Story otomatis hilang setelah 24 jam.</p>

            <button type="button" onclick="submitCreateStory('{{ route('stories.store') }}')"
                class="w-full bg-[#76ABAE] hover:bg-[#5CADB1] transition text-white text-sm font-semibold py-3 rounded-xl mt-2">
                Bagikan Story
            </button>
        </div>

    </div>
</div>
