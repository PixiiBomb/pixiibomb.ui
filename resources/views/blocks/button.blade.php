@use(PixiiBomb\Ui\Blocks\Icon)

@require($block)

@php
    $icon = $block->getIcon();
    $text = $block->getText();
@endphp

<button class="{{ $block->getClasses() }}" {!! $block->renderAttributes(['class']) !!}>
    @isset($icon)
        @block(new Icon($icon))
    @endisset

    @isset($text)
        {{ $block->getText() }}
    @endisset
</button>
