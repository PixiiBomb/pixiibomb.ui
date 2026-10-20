@use(PixiiBomb\Ui\Blocks\Icon)

@require($block)

@php
    $classes = $block?->getClasses();
    $icon = $block?->getIcon();
    $buttonClose = $block?->getButtonClose();
    $dismissable = $block?->getIsDismissible();
    $title = $block?->getTitle();
    $body = $block?->getBody();
@endphp

<div class="{{ $classes }}" {!! $block->renderAttributes(['class']) !!}>
    @isset($icon)
        <div class="alert-header">
            @block(new Icon($icon))
        </div>
    @endisset

    <div class="alert-body">
        @isset($title)
            <div class="alert-title">{{ $title }}</div>
        @endisset

        @isset($body)
            @if(is_string($body))
                {{ $body }}
            @elseif($body instanceof Block)
                @block($body)
            @endif
        @endisset
    </div>

    @if(isset($buttonClose) && $dismissable)
        <div class="alert-footer">
            @block($buttonClose)
        </div>
    @endif
</div>
