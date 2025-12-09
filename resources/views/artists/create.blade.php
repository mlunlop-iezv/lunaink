@extends('layouts.app')

@section('content')
    <div class="form-wrapper">
        <div class="form-card">
            <div class="nav-back">
                <a href="{{ route('artists.index') }}" class="back-link">
                    <span class="arrow">←</span> BACK TO ARTISTS
                </a>
            </div>
            <h2 class="form-title">NEW ARTIST PROFILE</h2>
            <p class="form-subtitle">Onboard a new talent to the studio</p>

            {{-- ERROR GENERAL (Catch) --}}
            @if($errors->has('general'))
                <div style="background: #ff4d4d; color: white; padding: 10px; margin-bottom: 15px; border-radius: 5px;">
                    {{ $errors->first('general') }}
                </div>
            @endif

            <form action="{{ route('artists.store') }}" method="POST" class="lunaink-form" novalidate>
                @csrf

                <div class="form-group">
                    <label for="name">Artist Name</label>
                    <input type="text" name="name" id="name" class="form-input" placeholder="E.g. MARIO LUNA"
                        value="{{ old('name') }}" required>

                    @error('name')
                        <span style="color: #ff4d4d; font-size: 0.8rem; margin-top: 5px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="bio">Biography / Short Description</label>
                    <textarea name="bio" id="bio" class="form-input form-textarea" rows="4"
                        placeholder="Brief description..." required>{{ old('bio') }}</textarea>

                    @error('bio')
                        <span style="color: #ff4d4d; font-size: 0.8rem; margin-top: 5px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-styles-section">
                    <label class="section-label">Top 3 Signature Styles</label>

                    @php
                        $oldStyles = old('styles', []); 
                    @endphp

                    <div class="form-styles-grid">
                        {{-- SELECT 1 --}}
                        <div class="style-select-wrapper">
                            
                            <select name="styles[]" class="form-input form-select" required>
                                <option value="" disabled {{ !isset($oldStyles[0]) ? 'selected' : '' }}>Primary Style
                                </option>
                                @foreach($styles as $style)
                                    <option value="{{ $style->id }}" {{ isset($oldStyles[0]) && $oldStyles[0] == $style->id ? 'selected' : '' }}>
                                        {{ $style->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="select-arrow">▼</div>
                        </div>

                        {{-- SELECT 2 --}}
                        <div class="style-select-wrapper">
                            
                            <select name="styles[]" class="form-input form-select">
                                <option value="" disabled {{ !isset($oldStyles[1]) ? 'selected' : '' }}>Secondary</option>
                                @foreach($styles as $style)
                                    <option value="{{ $style->id }}" {{ isset($oldStyles[1]) && $oldStyles[1] == $style->id ? 'selected' : '' }}>
                                        {{ $style->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="select-arrow">▼</div>
                        </div>

                        {{-- SELECT 3 --}}
                        <div class="style-select-wrapper">
                           
                            <select name="styles[]" class="form-input form-select">
                                <option value="" disabled {{ !isset($oldStyles[2]) ? 'selected' : '' }}>Tertiary</option>
                                @foreach($styles as $style)
                                    <option value="{{ $style->id }}" {{ isset($oldStyles[2]) && $oldStyles[2] == $style->id ? 'selected' : '' }}>
                                        {{ $style->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="select-arrow">▼</div>
                        </div>
                    </div>

                    @error('styles')
                        <span style="color: #ff4d4d; font-size: 0.8rem; margin-top: 5px; display: block;">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn-submit">
                    CREATE ARTIST PROFILE
                </button>
            </form>
        </div>
    </div>
@endsection