@props(['size' => 'md'])

@php
    $box = match ($size) {
        'sm' => 'w-8 h-8 text-sm',
        'lg' => 'w-14 h-14 text-2xl',
        default => 'w-9 h-9 text-base',
    };
@endphp

<div class="flex items-center gap-2">
    <div class="{{ $box }} rounded-xl bg-[#76ABAE] flex items-center justify-center font-bold text-white">I
    </div>
    <p class="font-bold text-[#76ABAE]">INSTA<span class="text-[#0A2947]">APP</span></p>
</div>
