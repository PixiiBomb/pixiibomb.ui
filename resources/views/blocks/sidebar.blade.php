@require($block)

@php
    $id = $block->getId();
    $style = $block->getStyle();
    $menuGroups = $block->getMenuGroups();
@endphp

<div class="sidebar {{ $style }}" id="{{ $id }}" aria-expanded="true">
    @isset($header)
        <div class="sidebar-header">
            @include('pixii::components.partials.content', ['content' => $header])
        </div>
    @endisset

    <div class="sidebar-body">
        @isset($menuGroups)
            @foreach($menuGroups as $group)
                {{ $group->getLabel() }}
                @foreach($group->getItems() as $item)
                    <a href="{{ $item->getRoute() }}" class="{{ $block->getActiveClassname($item->getRoute()) }}">
                        <div>
                            {{ $item->getLabel() }}
                        </div>
                    </a>
                @endforeach
            @endforeach
        @endisset
    </div>

    @isset($footer)
        <div class="sidebar-footer">
            @include('pixii::components.partials.content', ['content' => $footer])
        </div>
    @endisset
</div>
