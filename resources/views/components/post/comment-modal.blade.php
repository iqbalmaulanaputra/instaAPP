@props(['postId', 'comments' => []])

<div id="commentModal-{{ $postId }}"
    class="hidden fixed inset-0 z-50 items-center justify-center bg-black/50 backdrop-blur-sm px-4">
    <div class="bg-white w-full max-w-md rounded-2xl overflow-hidden shadow-xl max-h-[85vh] flex flex-col">

        <div class="relative flex items-center justify-center border-b border-[#76838F]/20 px-6 py-4 shrink-0">
            <button type="button" onclick="closeModal('commentModal-{{ $postId }}')"
                class="absolute left-4 w-8 h-8 rounded-full hover:bg-[#ECF0F3] transition flex items-center justify-center text-[#0A2947]">
                <i class='bx bx-x text-lg'></i>
            </button>
            <p class="text-sm font-semibold text-[#0A2947]">Komentar</p>
        </div>

        <div id="commentList-{{ $postId }}"
            class="overflow-y-auto scrollbar-hide flex-1 flex flex-col divide-y divide-[#76838F]/10">
            @foreach ($comments as $comment)
                <div class="flex items-start gap-3 px-4 py-3">
                    <div class="w-8 h-8 rounded-full bg-[#ECF0F3] shrink-0"></div>
                    <p class="text-sm text-[#0A2947]">
                        <span class="font-semibold">&#64;{{ $comment['username'] }}</span>
                        {{ $comment['text'] }}
                    </p>
                </div>
            @endforeach
        </div>

        <div class="flex items-center gap-2 px-4 py-3 border-t border-[#76838F]/30 shrink-0">
            <input type="text" id="commentInput-{{ $postId }}" placeholder="Tulis komentar..."
                onkeydown="if(event.key === 'Enter') addComment('{{ $postId }}')"
                class="flex-1 bg-[#ECF0F3] rounded-full px-4 py-2 text-sm text-[#0A2947] placeholder:text-[#0A2947]/40 focus:outline-none">
            <button type="button" onclick="addComment('{{ $postId }}')"
                class="w-9 h-9 rounded-full bg-[#76ABAE]/15 text-[#76ABAE] flex items-center justify-center hover:bg-[#76ABAE]/25 transition shrink-0">
                <i class='bx bx-send text-base'></i>
            </button>
        </div>

    </div>
</div>
