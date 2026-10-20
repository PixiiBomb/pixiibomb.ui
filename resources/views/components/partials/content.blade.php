@require($data)
@php $content = $data->getContent() @endphp

@isset($content)
    @if(is_string($content))
        {{ $content }}
    @elseif($content instanceof \PixiiBomb\Core\Data\SectionDirective)
        @yield($content->getName())
    @elseif($content instanceof \PixiiBomb\Core\Data\Block)
        @block($content)
    @elseif(is_array($content))
        @foreach($content as $item)
            <pre>{{ var_dump($item) }}</pre>
        @endforeach
    @else
        <div>Content Type: {{ is_array($content) ? "yes" : "no" }}</div>
    @endif
@endisset

