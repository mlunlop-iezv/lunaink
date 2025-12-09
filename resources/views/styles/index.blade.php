@extends('layouts.app')

@section('content')
    <section class="styles-section">
        <div class="content-container">

            <div class="section-header">
                <span class="section-label">CATEGORIES</span>
                <h2 class="section-title">Styles</h2>
                <p class="section-desc">
                    Explore our diverse range of tattoo styles. Click on a style to reveal the portfolio below.
                </p>
            </div>

            <div class="styles-grid">
                @foreach($styles as $style)
                    <a href="{{ route('styles.index', ['view_style' => $style->id]) }}"
                        class="style-card **tattoo-style-card-link** {{ (isset($selectedStyle) && $selectedStyle->id == $style->id) ? 'active' : '' }}">

                        <h3 class="style-card-title">{{ strtoupper($style->name) }}</h3>
                        <p class="style-card-desc">
                            {{ $style->description }}
                        </p>
                    </a>
                @endforeach
            </div>

            <div class="spacer-large"></div>

            @if(isset($selectedStyle))

                <div id="style-detail" class="style-preview-container">

                    <span class="pill-badge">{{ $selectedStyle->name }}</span>
                    <h2 class="preview-title">{{ $selectedStyle->name }} Tattoos</h2>
                    <p class="preview-desc">{{ $selectedStyle->description }}</p>

                    <div class="**style-gallery-grid**">

                        @forelse($selectedStyle->tattoos as $tattoo)
                            <a href="{{ route('tattoos.show', $tattoo) }}" class="preview-image-wrapper **style-gallery-image-link**">

                                <img src="{{ Str::startsWith($tattoo->image_url, 'http') ? $tattoo->image_url : asset($tattoo->image_url) }}"
                                    alt="{{ $tattoo->title }}"
                                    class="**style-gallery-img**">


                                <div class="image-caption-overlay">
                                    <h4 class="caption-title">{{ $tattoo->title }}</h4>
                                    <p class="caption-artist">by {{ $tattoo->artist->name }}</p>
                                </div>
                            </a>
                        @empty
                            <div class="**style-gallery-no-items-message**">
                                <p>No tattoos uploaded for this style yet.</p>
                            </div>
                        @endforelse

                    </div>
                </div>

            @else
                <div class="**style-select-prompt-message**">
                    <p>Select a style above to see the collection.</p>
                </div>
            @endif

        </div>
    </section>
@endsection