@use(PixiiBomb\Core\Support\PixiiAssetManager)

@php
    $meta = $page->getMeta();
    $template = $page->getTemplate();
    $theme = $template->getTheme();
    $layout = $page->getLayout();
    $blocks = $page->getBlocks();
    $assets = app(PixiiAssetManager::class);
    $import = $assets->resolveStylesheets(['pixii::themes/base/structures/_import']);
    $js = $assets->resolveScripts(['pixii-ui']);
    $vite = array_merge(
        $import,
        [
            $theme->getThemeStructureImport(),
            $theme->getPaletteStylesheet()
        ],
       $js
    );
@endphp

<!doctype html>
<html lang="">
<head>
    <title>{{ isset($meta) ? $meta->getTitle() : config('app.name') }}</title>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @isset($meta)
        <meta name="description" content="{{ $meta->getDescription() }}">
        <meta name="keywords" content="{{ $meta->getKeywords() }}">
        <meta name="author" content="{{ $meta->getAuthor() }}">
    @endisset

    @vite(array_merge($vite, $stylesheets, $scripts))

    @empty(!$layout->getStylesheets())
        @vite($layout->getStylesheets())
    @endempty
</head>

<body id="{{ $id }}" data-layout="{{ $layout->getAlias() }}" data-theme="{{ $theme->getPalette() }}">

@yield('layout')

@empty(!$layout->getScripts())
    @vite($layout->getScripts())
@endempty

</body>

</html>
