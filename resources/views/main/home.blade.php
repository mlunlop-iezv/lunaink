@extends('layouts.app')

@section('content')
    <section class="hero-section">
        <div class="hero-background-pattern"></div>

        <div class="hero-content">
            <h2 class="hero-subtitle">PREMIUM TATTOO ARTISTRY</h2>

            <h1 class="hero-title">LUNAINK</h1>

            <p class="hero-description">
                Where ancient symbolism meets futuristic aesthetics. We craft timeless pieces that transcend the ordinary.
            </p>

            <div class="hero-buttons">
                <a href="{{ route('tattoos.index') }}" class="btn-hero">
                    VIEW TATTOOS <span class="arrow">&rarr;</span>
                </a>
            </div>
        </div>

        <div class="scroll-indicator"></div>
    </section>
@endsection