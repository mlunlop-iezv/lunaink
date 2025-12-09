@extends('layouts.app')

@section('content')
    <div class="form-wrapper">
        <div class="form-card">
            <div class="nav-back">
                <a href="{{ route('artists.index') }}" class="back-link">
                    <span class="arrow">←</span> BACK TO ARTISTS
                </a>
            </div>

            <h2 class="form-title">EDIT ARTIST PROFILE</h2>
            <p class="form-subtitle">Update {{ $artist->name }}'s details</p>

            @if($errors->has('general'))
                <div style="background: #ff4d4d; color: white; padding: 10px; margin-bottom: 15px; border-radius: 5px;">
                    {{ $errors->first('general') }}
                </div>
            @endif

            <form action="{{ route('artists.update', $artist) }}" method="POST" class="lunaink-form" novalidate>
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Artist Name</label>
                    <input type="text" name="name" id="name" class="form-input" value="{{ old('name', $artist->name) }}"
                        placeholder="E.g. MARIO LUNA" required>
                    @error('name')
                        <span style="color: #ff4d4d; font-size: 0.8rem; margin-top: 5px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="bio">Biography</label>
                    <textarea name="bio" id="bio" class="form-input form-textarea" rows="4"
                        placeholder="Artist background..." required>{{ old('bio', $artist->bio) }}</textarea>
                    @error('bio')
                        <span style="color: #ff4d4d; font-size: 0.8rem; margin-top: 5px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-styles-section">
                    <label class="section-label">Signature Styles</label>

                    @php
                        $savedStyles = $artist->styles->pluck('id')->toArray();
                        $currentIds = old('styles', $savedStyles);
                    @endphp

                    <div class="form-styles-grid">

                        <div class="style-select-wrapper">
                            <select name="styles[]" class="form-input form-select" required>
                                <option value="" disabled>Primary Style</option>
                                @foreach($styles as $style)
                                    <option value="{{ $style->id }}" {{ isset($currentIds[0]) && $currentIds[0] == $style->id ? 'selected' : '' }}>
                                        {{ $style->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="select-arrow">▼</div>
                        </div>

                        <div class="style-select-wrapper">
                            <select name="styles[]" class="form-input form-select">
                                <option value="" disabled {{ !isset($currentIds[1]) ? 'selected' : '' }}>Secondary</option>
                                @foreach($styles as $style)
                                    <option value="{{ $style->id }}" {{ isset($currentIds[1]) && $currentIds[1] == $style->id ? 'selected' : '' }}>
                                        {{ $style->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="select-arrow">▼</div>
                        </div>

                        <div class="style-select-wrapper">
                            <select name="styles[]" class="form-input form-select">
                                <option value="" disabled {{ !isset($currentIds[2]) ? 'selected' : '' }}>Tertiary</option>
                                @foreach($styles as $style)
                                    <option value="{{ $style->id }}" {{ isset($currentIds[2]) && $currentIds[2] == $style->id ? 'selected' : '' }}>
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
                    UPDATE PROFILE
                </button>
            </form>
        </div>
    </div>
@endsection