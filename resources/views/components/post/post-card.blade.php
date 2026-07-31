@props(['post'])

@php
    $postId = $post->id;
@endphp

<div class="bg-white border border-[#76838F]/30 shadow-md rounded-2xl overflow-hidden">
    <div class="flex items-center justify-between px-4 py-3">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-full overflow-hidden bg-[#ECF0F3] shrink-0"></div>
            <div>
                <p class="text-sm font-semibold text-[#0A2947]">&#64;{{ $post->user->username }}</p>
            </div>
        </div>

        <button type="button" class="text-[#0A2947]/50 hover:text-[#76ABAE] transition text-lg">
            <i class='bx bx-dots-vertical-rounded'></i>
        </button>
    </div>

    <button type="button" onclick="openModal('postDetail-{{ $postId }}')"
        class="relative w-full aspect-square bg-[#ECF0F3] block">
        <img src="{{ Storage::url($post->image) }}" alt="{{ $post->caption }}" class="w-full h-full object-cover">
    </button>

    <div class="flex items-center justify-between px-4 pt-3 text-2xl text-[#0A2947]/70">
        <div class="flex items-center gap-4">
            <button type="button" onclick="toggleLike('{{ $postId }}', this)"
                title="{{ $post->likes_count }} suka"
                class="flex items-center gap-1.5 hover:text-rose-500 transition {{ $post->isLikedBy(auth()->id()) ? 'text-rose-500' : '' }}">
                <i class='bx {{ $post->isLikedBy(auth()->id()) ? 'bxs-heart' : 'bx-heart' }}'></i>
                @if ($post->likes_count > 0)
                    <span id="likeCount-{{ $postId }}" class="text-sm font-medium">{{ $post->likes_count }}</span>
                @endif
            </button>

            <button type="button" onclick="openModal('postDetail-{{ $postId }}')"
                title="{{ $post->comments_count }} komentar"
                class="flex items-center gap-1.5 hover:text-[#76ABAE] transition">
                <i class='bx bx-comment'></i>
                @if ($post->comments_count > 0)
                    <span id="commentCount-{{ $postId }}"
                        class="text-sm font-medium">{{ $post->comments_count }}</span>
                @endif
            </button>
        </div>

        <button type="button" onclick="toggleSave('{{ $postId }}', this)"
            class="hover:text-[#76ABAE] transition {{ $post->isSavedBy(auth()->id()) ? 'text-[#76ABAE]' : '' }}">
            <i class='bx {{ $post->isSavedBy(auth()->id()) ? 'bxs-bookmark' : 'bx-bookmark' }}'></i>
        </button>
    </div>

    @if ($post->caption)
        <p class="px-4 pt-3 text-sm text-[#0A2947]/80">
            <span class="font-semibold text-[#0A2947]">&#64;{{ $post->user->username }}</span>
            {{ $post->caption }}
        </p>
    @endif

    <p class="px-4 pt-2 pb-4 text-[11px] text-[#0A2947]/40 uppercase tracking-wide">
        {{ $post->created_at->translatedFormat('d M Y') }}
    </p>

    <x-post.post-detail-modal :post="$post" />
</div>
