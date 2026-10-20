@php
    $sourceCode = $code ?? (
        isset($source)
            ? (string) $source
            : null
    );
@endphp

<div {{ $attributes->class('code-example') }}>
    @isset($preview)
        <div class="code-example-preview">
            {{ $preview }}
        </div>
    @endisset

    @if ($sourceCode !== null)
        <div class="code-example-source">
            <div class="code-example-source-header">
                <span>{{ $getLabel() }}</span>
            </div>

            <pre><code class="language-{{ $language }}">{!! e($formatSource($sourceCode)) !!}</code></pre>
        </div>
    @endif
</div>
