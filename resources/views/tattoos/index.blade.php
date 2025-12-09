@extends('layouts.app')

@section('content')

    <section class="gallery-section">

        <div class="gallery-header">
            <span class="gallery-label">GALLERY</span>
            <h1 class="gallery-title">Our Work</h1>
            <p class="gallery-description">
                Each piece tells a story. Browse our collection of custom tattoos crafted by our talented artists.
            </p>
        </div>
        <div class="filter-bar">
            <a href="{{ route('tattoos.index') }}" class="filter-btn {{ request('style') ? '' : 'active' }}">
                All
            </a>

            @foreach($styles as $style)
                <a href="{{ route('tattoos.index', ['style' => $style->id]) }}"
                    class="filter-btn {{ request('style') == $style->id ? 'active' : '' }}">
                    {{ $style->name }}
                </a>
            @endforeach
        </div>

        <div class="gallery-grid">
            @if(empty($tattoos))
                <p>No hay tattoos por mostrar</p>
            @else
                @foreach($tattoos as $tattoo)
                    <div class="col">
                        <div class="card shadow-sm" style="min-height: 400px; border: 1px solid #222; background: #0a0a0a;">

                            {{-- IMAGEN SVG --}}
                            {{-- Nota: background-image se queda aquí porque es DINÁMICO. El resto se fue al CSS (.tattoo-bg-image)
                            --}}
                            <svg class="bd-placeholder-img card-img-top tattoo-bg-image" width="100%" height="225"
                                xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: {{ $tattoo->title }}"
                                preserveAspectRatio="xMidYMid slice" focusable="false"
                                style="background-image: url('{{ $tattoo->getPath() }}');"
                                onclick="window.location='{{ route('tattoos.show', $tattoo) }}'">

                                <title>{{ $tattoo->title }}</title>
                                <rect width="100%" height="100%" fill="#00000080"></rect>
                                <text x="50%" y="50%" fill="#ffffff" dy=".3em" text-anchor="middle"
                                    style="font-family: 'Montserrat', sans-serif; font-weight: 700; font-size: 1.2rem; text-transform: uppercase; letter-spacing: 1px;">
                                    {{ $tattoo->title }}
                                </text>
                            </svg>

                            {{-- CUERPO DE LA TARJETA (Con la nueva clase para el padding) --}}
                            <div class="tattoo-card-body">
                                <div class="card-text">
                                    {{-- Usamos las clases helper creadas en el CSS para ordenar esto --}}
                                    <div style="margin-bottom: 15px;">
                                        <span class="label-small">Style</span>
                                        <span class="label-value">{{ $tattoo->style->name }}</span>
                                    </div>

                                    <div>
                                        <span class="label-small">Artist</span>
                                        <span class="label-value">{{ $tattoo->artist->name }}</span>
                                    </div>
                                </div>

                                {{-- BOTONES --}}
                                <div class="card-actions">
                                    <a href="{{ route('tattoos.show', $tattoo) }}" class="btn-custom btn-view">VIEW</a>
                                    <a href="{{ route('tattoos.edit', $tattoo) }}" class="btn-custom btn-edit">EDIT</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </section>

    </body>

    </html>
@endsection