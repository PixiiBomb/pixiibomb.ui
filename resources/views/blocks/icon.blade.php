@require($block)

@php
    $icon = $block?->getIcon();
@endphp

@isset($icon)
    <i class="{{ $icon }}"></i>
@endisset
