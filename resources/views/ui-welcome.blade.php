@php
    $template = $page->getTemplate();
    $theme = $template->getTheme();
@endphp

<div class="feature-gradient-bg banner-container">
    <div class="rain background" aria-hidden="true"></div>
    <div class="particle background" aria-hidden="true"></div>

    <div id="banner" aria-hidden="true"></div>

    <div class="container grow d-flex feature-content">
        <div class="row grow w-100">
            <div class="col-12 text-center d-flex flex-column justify-content-center">
                <div class="pixii-orb-card">
                    <div class="pixii-icon-tile">
                        <span class="pixii-icon">🧚‍♀️</span>
                    </div>
                </div>

                <h1>pixiibomb.ui</h1>
            </div>
        </div>
    </div>

    <div class="particle foreground" aria-hidden="true"></div>
</div>
<div class="package-install-container">
    <div class="container my-5">
        <div class="row">
            <div class="col-12 mb-3">
                <div class="card">
                    <div class="card-body package-details-container">
                        <div class="package-icon">
                            <span>🎨</span>
                        </div>
                        <div class="package-details">
                            <strong>theme: {{ $theme->getName() }}</strong>
                            <span>palette: {{ $theme->getPalette() }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @foreach($packages as $package)
                <div class="col-4">
                    <div class="card">
                        <div class="card-body package-details-container">
                            <div class="package-icon">
                                <span>📦</span>
                            </div>
                            <div class="package-details">
                                <strong>{{ $package['name'] }}</strong>
                                <span>v. {{ $package['version'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>
    </div>
</div>
