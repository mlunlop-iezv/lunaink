@extends('layouts.app')

@section('content')
    <div class="tattoo-detail-wrapper">
        <div class="tattoo-image-col">
            <div class="nav-back" style="margin-bottom: 20px;">
                <a href="{{ route('tattoos.index') }}" class="back-link">
                    <span class="arrow">←</span> BACK TO TATTOOS
                </a>
            </div>
            <div class="image-frame">
                <img src="{{ Str::startsWith($tattoo->image_url, 'http') ? $tattoo->image_url : asset($tattoo->image_url) }}"
                    alt="{{ $tattoo->title }}" class="main-tattoo-img">
            </div>
        </div>

        <div class="tattoo-info-col">

            <span class="detail-tag">{{ $tattoo->style->name }}</span>

            <h1 class="detail-title">{{ $tattoo->title }}</h1>

            <div class="divider"></div>

            <div class="specs-grid">
                <div class="spec-item">
                    <h4 class="spec-label">DURATION</h4>
                    <p class="spec-value">{{ $tattoo->duration }}</p>
                </div>
                <div class="spec-item">
                    <h4 class="spec-label">STYLE</h4>
                    <p class="spec-value">{{ $tattoo->style->name }}</p>
                </div>
            </div>

            <div class="divider"></div>

            <div class="artist-mini-profile">
                <div class="artist-meta">
                    <span class="meta-label">ARTIST</span>
                    <a href="{{ route('artists.show', $tattoo->artist) }}" class="meta-name" style="text-decoration: underline; color: inherit;">
                        {{ $tattoo->artist->name }}
                    </a>
                </div>
            </div>

            <div class="action-buttons">
                
                <a href="{{ route('tattoos.edit', $tattoo) }}" class="btn-action" style="text-decoration: none; display: inline-flex; align-items: center; gap: 5px;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                    </svg>
                    EDIT
                </a>

                <form action="{{ route('tattoos.destroy', $tattoo) }}" method="POST" onsubmit="return confirm('Are you sure?');" style="display:inline;">
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

        </div>
    </div>
@endsection