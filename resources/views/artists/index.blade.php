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
        {{-- AÑADIDO: onclick para ir al show y style cursor para que parezca un enlace --}}
        <div class="artist-card" onclick="window.location='{{ route('artists.show', $artist) }}'" style="cursor: pointer;">
            
            <div class="card-content">
                {{-- 1. NOMBRE DINÁMICO (Usamos strtoupper para mantener tu estilo mayúsculas) --}}
                <h3 class="artist-name">{{ strtoupper($artist->name) }}</h3>
                
                {{-- 2. ROL (Como no tienes columna 'role' en BD, lo dejamos fijo o lo borras) --}}
                <p class="artist-role">Resident Artist</p>
                
                {{-- 3. BIO DINÁMICA --}}
                <p class="artist-bio">
                    {{ $artist->bio }}
                </p>
                
                {{-- 4. ESTILOS DINÁMICOS (Respetando tus spans y dots) --}}
                <div class="artist-tags">
                    @foreach($artist->styles as $style)
                        <span>{{ strtoupper($style->name) }}</span>
                        
                        {{-- Solo ponemos el punto si NO es el último estilo --}}
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