<div id="storyViewerModal"
    class="hidden fixed inset-0 z-60 items-center justify-center bg-black sm:bg-black/80 px-0 sm:px-4">
    <div class="relative w-full h-full sm:h-[90vh] sm:max-w-sm sm:rounded-2xl overflow-hidden bg-black">

        <div id="storyProgressBars" class="absolute top-2 left-2 right-2 z-20 flex gap-1"></div>

        <div class="absolute top-6 left-2 right-2 z-20 flex items-center justify-between">
            <span id="storyViewerUsername" class="text-white text-sm font-semibold drop-shadow"></span>
            <button type="button" onclick="closeStoryViewer()"
                class="w-8 h-8 rounded-full bg-black/30 flex items-center justify-center text-white">
                <i class='bx bx-x text-lg'></i>
            </button>
        </div>

        <img id="storyViewerImage" src="" alt="story" class="w-full h-full object-contain">

        <button type="button" onclick="prevStory()" class="absolute left-0 top-0 h-full w-1/3 z-10"></button>
        <button type="button" onclick="nextStory()" class="absolute right-0 top-0 h-full w-1/3 z-10"></button>
    </div>
</div>
