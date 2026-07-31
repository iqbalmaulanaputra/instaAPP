@props(['href', 'icon', 'label' => null, 'variant' => 'sidebar', 'authRequired' => false])

@php
    $isActive = request()->is(ltrim(parse_url($href, PHP_URL_PATH), '/') ?: '/');
    $blocked = $authRequired && !auth()->check();

    $base =
        $variant === 'sidebar'
            ? 'flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition text-left'
            : 'flex flex-col items-center justify-center w-14 h-14 rounded-xl transition';

    $state = $isActive
        ? ($variant === 'sidebar'
            ? 'bg-[#76ABAE] text-white'
            : 'text-[#76ABAE]')
        : ($variant === 'sidebar'
            ? 'text-[#0A2947]/60 hover:bg-[#76ABAE] hover:text-white'
            : 'text-[#0A2947]/50');

    $onclick = $blocked
        ? "openModal('authModal'); showToast('info', 'Silakan masuk terlebih dahulu.')"
        : "window.location.href='{$href}'";
@endphp

<button type="button" onclick="{{ $onclick }}" class="{{ $base }} {{ $state }}">
    <i class='bx {{ $icon }} text-lg'></i>
    @if ($label)
        {{ $label }}
    @endif
</button>
