<section {{ $attributes->class('doc-section') }} id="{{ $getAnchor() }}">
    @if ($title !== null || $description !== null)
        <header class="section-header">
            @if ($title !== null)
                <h{{$h}}>
                    {{ $title }}
                </h{{$h}}>
            @endif

            @if ($description !== null)
                <p class="lead">{{ $description }}</p>
            @endif
        </header>
    @endif

    @if (!$slot->isEmpty())
        <div class="section-body">
            {{ $slot }}
        </div>
    @endif
</section>
