@props(['post'])

@php
    $postId = $post->id;
@endphp

<div id="postDetail-{{ $postId }}"
    class="hidden fixed inset-0 z-50 items-center justify-center bg-black/50 backdrop-blur-sm px-4">
    <div
        class="relative bg-white w-full max-w-3xl rounded-2xl overflow-hidden shadow-xl max-h-[90vh] flex flex-col sm:flex-row">

        <button type="button" onclick="closeModal('postDetail-{{ $postId }}')"
            class="absolute top-3 right-3 w-8 h-8 rounded-full bg-black/40 hover:bg-black/60 transition flex items-center justify-center text-white z-10">
            <i class='bx bx-x text-lg'></i>
        </button>

        <div class="w-full sm:w-1/2 aspect-square bg-black shrink-0">
            <img src="{{ Storage::url($post->image) }}" alt="{{ $post->caption }}" class="w-full h-full object-cover">
        </div>

        <div class="w-full sm:w-1/2 flex flex-col max-h-[50vh] sm:max-h-[90vh]">

            <div class="flex items-center gap-3 px-4 py-3 border-b border-[#76838F]/20 shrink-0">
                <div
                    class="w-8 h-8 rounded-full bg-[#ECF0F3] shrink-0 overflow-hidden flex items-center justify-center font-bold text-xs text-[#76ABAE]">
                    @if ($post->user->avatar)
                        <img src="{{ Storage::url($post->user->avatar) }}" alt="{{ $post->user->username }}"
                            class="w-full h-full object-cover">
                    @else
                        {{ strtoupper(substr($post->user->username, 0, 1)) }}
                    @endif
                </div>
                <p class="text-sm font-semibold text-[#0A2947]">&#64;{{ $post->user->username }}</p>
            </div>

            <div id="commentList-{{ $postId }}"
                class="overflow-y-auto scrollbar-hide flex-1 flex flex-col divide-y divide-[#76838F]/10">
                @if ($post->caption)
                    <div class="flex items-center gap-3 px-4 py-3">
                        <div
                            class="w-8 h-8 rounded-full bg-[#ECF0F3] shrink-0 overflow-hidden flex items-center justify-center font-bold text-xs text-[#76ABAE]">
                            @if ($post->user->avatar)
                                <img src="{{ Storage::url($post->user->avatar) }}" alt="{{ $post->user->username }}"
                                    class="w-full h-full object-cover">
                            @else
                                {{ strtoupper(substr($post->user->username, 0, 1)) }}
                            @endif
                        </div>
                        <p class="text-sm text-[#0A2947]">
                            <span class="font-semibold">&#64;{{ $post->user->username }}</span>
                            {{ $post->caption }}
                        </p>
                    </div>
                @endif

                @foreach ($post->comments as $comment)
                    <div class="flex items-center gap-3 px-4 py-3">
                        <div
                            class="w-8 h-8 rounded-full bg-[#ECF0F3] shrink-0 overflow-hidden flex items-center justify-center font-bold text-xs text-[#76ABAE]">
                            @if ($comment->user->avatar)
                                <img src="{{ Storage::url($comment->user->avatar) }}"
                                    alt="{{ $comment->user->username }}" class="w-full h-full object-cover">
                            @else
                                {{ strtoupper(substr($comment->user->username, 0, 1)) }}
                            @endif
                        </div>
                        <p class="text-sm text-[#0A2947]">
                            <span class="font-semibold">&#64;{{ $comment->user->username }}</span>
                            {{ $comment->comment }}
                        </p>
                    </div>
                @endforeach
            </div>

            <div
                class="flex items-center gap-4 px-4 py-3 border-t border-[#76838F]/20 text-2xl text-[#0A2947]/70 shrink-0">
                <button type="button" onclick="toggleLike('{{ $postId }}', this)"
                    title="{{ $post->likes_count }} suka"
                    class="flex items-center gap-1.5 hover:text-rose-500 transition {{ $post->isLikedBy(auth()->id()) ? 'text-rose-500' : '' }}">
                    <i class='bx {{ $post->isLikedBy(auth()->id()) ? 'bxs-heart' : 'bx-heart' }}'></i>
                    <span id="likeCount-{{ $postId }}"
                        class="text-sm font-medium">{{ $post->likes_count }}</span>
                </button>

                <div class="flex items-center gap-1.5" title="{{ $post->comments_count }} komentar">
                    <i class='bx bx-comment'></i>
                    <span id="commentCount-{{ $postId }}"
                        class="text-sm font-medium">{{ $post->comments_count }}</span>
                </div>
            </div>

            <div class="flex items-center gap-2 px-4 py-3 border-t border-[#76838F]/30 shrink-0">
                <input type="text" id="commentInput-{{ $postId }}" placeholder="Tulis balasan..."
                    onkeydown="if(event.key === 'Enter') addComment('{{ $postId }}')"
                    class="flex-1 bg-[#ECF0F3] rounded-full px-4 py-2 text-sm text-[#0A2947] placeholder:text-[#0A2947]/40 focus:outline-none">
                <button type="button" onclick="addComment('{{ $postId }}')"
                    class="w-9 h-9 rounded-full bg-[#76ABAE]/15 text-[#76ABAE] flex items-center justify-center hover:bg-[#76ABAE]/25 transition shrink-0">
                    <i class='bx bx-send text-base'></i>
                </button>
            </div>

        </div>

    </div>
</div>
