@require($block)

@php
    $title = $block?->getTitle();
    $description = $block?->getDescription();
    $body = $block?->getBody();
@endphp

<section class="component-preview">
    <header class="component-preview-header">
        <h{{ $block->getH() }}>{{ $title }}</h{{ $block->getH() }}>
        <p class="lead">{{ $description }}</p>
    </header>

    @empty(!$body)
        @foreach($body as $b)
            @block($b)
        @endforeach
    @endempty

</section>
