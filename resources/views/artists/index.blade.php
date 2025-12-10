@extends('layouts.app')

@section('content')
<section class="artists-section">
    <div class="content-container">

        <div class="section-header">
            <span class="section-label">THE TEAM</span>
            <h2 class="section-title">Our Artists</h2>
            <p class="section-desc">
                Meet the talented artists behind LunaInk. Each brings their unique perspective and expertise to create one-of-a-kind pieces.
            </p>
        </div>

        <div class="artists-list">
    @foreach($artists as $artist)
        <div class="artist-card" onclick="window.location='{{ route('artists.show', $artist) }}'" style="cursor: pointer;">

            <div class="card-content">
                <h3 class="artist-name">{{ strtoupper($artist->name) }}</h3>

                <p class="artist-role">Resident Artist</p>

                <p class="artist-bio">
                    {{ $artist->bio }}
                </p>

                <div class="artist-tags">
                    @foreach($artist->styles as $style)
                        <span>{{ strtoupper($style->name) }}</span>

                        @if(!$loop->last)
                            <span class="dot">•</span>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="card-action">
                <span class="arrow">→</span>
            </div>
        </div>
    @endforeach

    <a href="{{ route('artists.create') }}" class="btn-book">+ ADD A NEW ARTIST</a>
</div>

    </div>
</section>
@endsection