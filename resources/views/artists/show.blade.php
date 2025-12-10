@extends('layouts.app')

@section('content')
    <div class="artist-detail-wrapper">

        <div class="nav-back">
            <a href="{{ route('artists.index') }}" class="back-link">
                <span class="arrow">←</span> BACK TO ARTISTS
            </a>
        </div>

        <header class="artist-header">
            <span class="label-small">ARTIST PROFILE</span>
            <h1 class="artist-name">{{ strtoupper($artist->name) }}</h1>

            <div class="artist-bio-container">
                <p class="artist-bio">
                    {{ $artist->bio }}
                </div>

            <div class="artist-tags">
                @foreach($artist->styles as $style)
                    <span class="tag-pill">{{ strtoupper($style->name) }}</span>
                @endforeach
            </div>
        </header>
        <div class="action-buttons">

            <a href="{{ route('artists.edit', $artist) }}" class="btn-action"
                style="text-decoration: none; display: inline-flex; align-items: center; gap: 5px;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                </svg>
                EDIT
            </a>

            <form action="{{ route('artists.destroy', $artist) }}" method="POST" onsubmit="return confirm('Are you sure?');"
                style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-action warning" style="cursor: pointer;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="3 6 5 6 21 6"></polyline>
                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                        <line x1="10" y1="11" x2="10" y2="17"></line>
                        <line x1="14" y1="11" x2="14" y2="17"></line>
                    </svg>
                    DELETE
                </button>
            </form>
        </div>

        <section class="portfolio-section">
            <div class="section-divider"></div>

            <div class="portfolio-header">
                <span class="label-small">PORTFOLIO</span>
                <h2 class="portfolio-title">Work by {{$artist->name}}</h2>
            </div>


            <div class="portfolio-grid">

                @forelse($artist->tattoos as $tattoo)
                    <a href="{{ route('tattoos.show', $tattoo) }}" class="portfolio-item">

                        <div class="image-wrapper">
                            <img src="{{ Str::startsWith($tattoo->image_url, 'http') ? $tattoo->image_url : asset($tattoo->image_url) }}"
                                alt="{{ $tattoo->title }}" class="portfolio-img">

                            <span class="floating-tag">{{ strtoupper($tattoo->style->name) }}</span>
                        </div>

                        <div class="tattoo-info">
                            <h3 class="tattoo-title">{{ $tattoo->title }}</h3>
                            <span class="tattoo-date">{{ $tattoo->created_at->format('M Y') }}</span>
                        </div>
                    </a>

                @empty
                    <div class="portfolio-empty">
                        <p class="empty-text">No masterpieces uploaded yet.</p>
                    </div>
                @endforelse

            </div>
        </section>

    </div>
@endsection