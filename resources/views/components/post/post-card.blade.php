@props([
    'id' => null,
    'username' => 'username',
    'location' => '',
    'filter' => null,
    'likes' => 0,
    'caption' => '',
    'date' => '',
    'comments' => [],
])

@php
    $postId = $id ?? uniqid('post_');
    $comments = count($comments)
        ? $comments
        : [
            ['username' => 'dian_photoworks', 'text' => 'Keren banget suasananya! 😍'],
            ['username' => 'budi_explorer', 'text' => 'Boleh dong lokasi tepatnya di mana?'],
        ];
    $previewComments = array_slice($comments, 0, 2);
@endphp

<div class="bg-white border border-[#76838F]/30 shadow-md rounded-2xl overflow-hidden">
    <div class="flex items-center justify-between px-4 py-3">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-full overflow-hidden bg-[#ECF0F3] shrink-0"></div>
            <div>
                <p class="text-sm font-semibold text-[#0A2947]">&#64;{{ $username }}</p>
                @if ($location)
                    <p class="text-xs text-[#0A2947]/50">{{ $location }}</p>
                @endif
            </div>
        </div>

        <button type="button" class="text-[#0A2947]/50 hover:text-[#76ABAE] transition text-lg">
            <i class='bx bx-dots-vertical-rounded'></i>
        </button>
    </div>

    <div class="relative w-full aspect-square bg-[#ECF0F3]">
        {{ $slot }}

        @if ($filter)
            <span
                class="absolute top-3 right-3 text-[10px] font-semibold tracking-wider bg-black/60 text-white px-3 py-1 rounded-full uppercase">
                {{ $filter }}
            </span>
        @endif
    </div>

    <div class="flex items-center justify-between px-4 pt-3 text-2xl text-[#0A2947]/70">
        <div class="flex items-center gap-4">
            <button type="button" class="flex items-center gap-1.5 hover:text-rose-500 transition">
                <i class='bx bx-heart'></i>
                @if ($likes > 0)
                    <span class="text-sm font-medium">{{ $likes }}</span>
                @endif
            </button>

            <button type="button" onclick="openModal('commentModal-{{ $postId }}')"
                class="flex items-center gap-1.5 hover:text-[#76ABAE] transition">
                <i class='bx bx-comment'></i>
                @if (count($comments) > 0)
                    <span id="commentCount-{{ $postId }}"
                        class="text-sm font-medium">{{ count($comments) }}</span>
                @endif
            </button>
        </div>

        <button type="button" onclick="toggleSave('{{ $postId }}', this)"
            class="hover:text-[#76ABAE] transition">
            <i class='bx bx-bookmark'></i>
        </button>
    </div>

    @if ($caption)
        <p class="px-4 pt-3 text-sm text-[#0A2947]/80">
            <span class="font-semibold text-[#0A2947]">&#64;{{ $username }}</span>
            {{ $caption }}
        </p>
    @endif

    @if (count($comments) > 0)
        <div class="px-4 pt-2 flex flex-col gap-1">
            @if (count($comments) > 2)
                <button type="button" onclick="openModal('commentModal-{{ $postId }}')"
                    class="text-left text-sm text-[#0A2947]/40 hover:text-[#76ABAE] transition">
                    Lihat semua {{ count($comments) }} komentar
                </button>
            @endif

            @foreach ($previewComments as $comment)
                <p class="text-sm text-[#0A2947]/80">
                    <span class="font-semibold text-[#0A2947]">&#64;{{ $comment['username'] }}</span>
                    {{ $comment['text'] }}
                </p>
            @endforeach
        </div>
    @endif

    @if ($date)
        <p class="px-4 pt-2 pb-4 text-[11px] text-[#0A2947]/40 uppercase tracking-wide">{{ $date }}</p>
    @endif

    <x-post.comment-modal :post-id="$postId" :comments="$comments" />
</div>
