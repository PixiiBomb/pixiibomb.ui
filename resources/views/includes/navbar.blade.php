@php
    $themeService = app(\PixiiBomb\Ui\Services\PixiiBombThemeService::class);
    $themes = $themeService->getThemes();
    $activeTheme = $themeService->getActiveTheme();
@endphp

<style>
    .user-menu-trigger {
        align-items: center;
        background: transparent;
        border: 1px solid var(--border-glass);
        border-radius: var(--radius-round);
        width: var(--icon-lg);
        height: var(--icon-lg);
        cursor: pointer;
        display: inline-flex;
        justify-content: center;
        transition:
            background-color 150ms ease,
            border-color 150ms ease,
            transform 150ms ease;
    }

    .user-menu-trigger:hover {
        background: var(--color-primary-10);
        border-color: var(--color-primary);
    }

    .user-menu-trigger:active {
        transform: scale(0.96);
    }

    .theme-trigger-icon {
        font-size: 1.25rem;
        color: var(--color-primary);
        line-height: 1;
    }

    .theme-dropdown {
        flex-direction: column;
        gap: var(--padding);
        min-width: 20rem;
        width: min(22rem, calc(100vw - 2rem));
    }

    .theme-dropdown-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .theme-dropdown-title {
        font-weight: 700;
    }

    .theme-count {
        align-items: center;
        background: var(--bs-tertiary-bg);
        border-radius: 999px;
        color: var(--bs-secondary-color);
        display: inline-flex;
        font-size: 0.7rem;
        font-weight: 700;
        height: 1.6rem;
        justify-content: center;
        min-width: 1.6rem;
    }

    .theme-list {
        max-height: min(26rem, 65vh);
        overflow-y: auto;
        overscroll-behavior: contain;
        scrollbar-width: thin;
    }

    .filter-item {
        display: none;
    }

    .filter-item.show {
        display: block;
    }

    .theme-group {
        border-top: 1px solid var(--color-border-primary);
        padding: var(--padding) 0;
    }

    .theme-group:first-child {
        border-top: 0;
    }

    .theme-group-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .theme-name-wrapper {
        align-items: center;
        display: flex;
        gap: 0.55rem;
        min-width: 0;
    }

    .theme-preview {
        display: inline-flex;
        flex: 0 0 auto;
        align-items: center;
        background: var(--surface-glass);
        border: 1px solid var(--border-glass);
        border-radius: var(--icon-sm);
        width: var(--icon-sm);
        height: var(--icon-sm);
        color: var(--color-primary);
        padding: var(--padding-sm);
        font-size: var(--font-xs);
        font-weight: 800;
        justify-content: center;
    }

    .theme-name {
        font-size: var(--font-sm);
        font-weight: 700;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .active-theme-badge {
        background: var(--color-success-30);
        border-radius: var(--border);
        color: var(--color-success);
        font-size: 0.62rem;
        font-weight: 800;
        letter-spacing: 0.035em;
        text-transform: uppercase;
    }

    .palette-list {
        display: grid;
        gap: 0.25rem;
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .palette-form {
        display: flex;
        flex-direction: column;
        gap: var(--padding);
    }

    .palette-name {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .palette-selected-icon {
        flex: 0 0 auto;
        font-size: 0.75rem;
        font-weight: 900;
    }

    .palette-empty {
        color: var(--bs-secondary-color);
        font-size: 0.72rem;
        grid-column: 1 / -1;
    }

    .theme-no-results {
        color: var(--bs-secondary-color);
        display: none;
        font-size: 0.78rem;
        text-align: center;
    }

    .theme-no-results.show {
        display: block;
    }

    @media (max-width: 575.98px) {
        .theme-dropdown {
            min-width: 18rem;
        }

        .palette-list {
            grid-template-columns: 1fr;
        }
    }
</style>

<nav class="navbar navbar-expand-lg fixed-top navbar-flush app-navbar">
    <div class="container">

        <a class="navbar-brand app-brand" href="/">
            <span>{{ config('app.name') }}</span>
        </a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#pixii-navbar"
            aria-controls="pixii-navbar"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="pixii-navbar">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">

                <li class="nav-item dropdown user-menu" data-bs-auto-close="outside">

                    <button
                        class="user-menu-trigger user-avatar"
                        type="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                        aria-label="Select theme"
                    >
                        <span class="theme-trigger-icon"><i class="bi bi-circle-half"></i></span>
                    </button>

                    <div class="dropdown-menu dropdown-menu-end theme-dropdown" id="theme-dropdown">
                        <div class="theme-dropdown-header">
                            <div>
                                <div class="theme-dropdown-title">
                                    Theme
                                </div>

                                <div class="text-muted">
                                    Choose a theme and palette
                                </div>
                            </div>

                            <span class="theme-count">
                                {{ count($themes) }}
                            </span>
                        </div>

                        <div class="input-group">
                            <span class="input-group-text" id="theme-search-icon"><i class="bi bi-search"></i></span>
                            <input id="theme-search" type="search" class="form-control" placeholder="Search themes or palettes..."
                                   autocomplete="on"
                                   aria-label="Search themes and palettes" aria-describedby="theme-search-icon">
                        </div>


                        <div class="theme-list" id="themeList">
                            @foreach($themes as $theme)
                                @php
                                    $isActiveTheme =
                                        $activeTheme?->getName() === $theme->getName();

                                    $searchTerms = collect([
                                        $theme->getName(),
                                        ...$theme->getPalettes(),
                                    ])
                                        ->implode(' ');
                                @endphp

                                <section
                                    class="filter-item theme-group show"
                                    data-theme-filter="{{ $searchTerms }}"
                                >
                                    <div class="theme-group-header">
                                        <div class="theme-name-wrapper">
                                            <span class="theme-preview">
                                                {{ strtoupper(substr($theme->getName(), 0, 1)) }}
                                            </span>

                                            <span class="theme-name">
                                                {{ ucfirst($theme->getName()) }}
                                            </span>
                                        </div>

                                        @if($isActiveTheme)
                                            <span class="badge rounded-pill text-bg-success">
                                                Active
                                            </span>
                                        @endif
                                    </div>

                                    <div class="palette-list">
                                        @forelse($theme->getPalettes() as $palette)
                                            @php
                                                $isActivePalette =
                                                    $isActiveTheme
                                                    && $activeTheme?->getPalette() === $palette;
                                            @endphp

                                            <form method="POST" action="/theme/{{ $theme->getName() }}/{{ $palette }}" class="palette-form">
                                                @csrf

                                                <button type="submit"
                                                        class="btn btn-outline-{{ $isActivePalette ? 'primary' : 'secondary' }}"
                                                        data-palette-filter="{{ strtolower($palette) }}">
                                                    <span class="palette-name">
                                                        {{ ucfirst($palette) }}
                                                    </span>

                                                    @if($isActivePalette)
                                                        <span class="palette-selected-icon" aria-label="Selected">
                                                            <i class="bi bi-check-circle-fill"></i>
                                                        </span>
                                                    @endif
                                                </button>
                                            </form>
                                        @empty
                                            <div class="palette-empty">
                                                No palettes available
                                            </div>
                                        @endforelse
                                    </div>
                                </section>
                            @endforeach

                            <div class="theme-no-results" id="themeNoResults">
                                No themes or palettes match your search.
                            </div>
                        </div>
                    </div>
                </li>

            </ul>
        </div>

    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const search = document.getElementById('theme-search');
        const themeGroups = Array.from(
            document.querySelectorAll('#themeList .filter-item')
        );
        const noResults = document.getElementById('themeNoResults');

        if (!search || themeGroups.length === 0 || !noResults) {
            return;
        }

        const normalize = (value) => {
            return value
                .toLowerCase()
                .trim()
                .replace(/\s+/g, ' ');
        };

        const filterThemes = () => {
            const query = normalize(search.value);
            let visibleCount = 0;

            themeGroups.forEach((group) => {
                const searchTerms = normalize(
                    group.dataset.themeFilter ?? ''
                );

                const isVisible =
                    query.length === 0 || searchTerms.includes(query);

                group.classList.toggle('show', isVisible);

                if (isVisible) {
                    visibleCount++;
                }
            });

            noResults.classList.toggle('show', visibleCount === 0);
        };

        search.addEventListener('input', filterThemes);

        document
            .getElementById('theme-dropdown')
            ?.addEventListener('shown.bs.dropdown', () => {
                search.focus();
            });
    });
</script>
