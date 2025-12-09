@extends('layouts.app')

@section('content')
    <div class="form-wrapper">
        <div class="form-card">
            <div class="nav-back">
                <a href="{{ route('tattoos.index') }}" class="back-link">
                    <span class="arrow">←</span> BACK TO HOME
                </a>
            </div>
            <h2 class="form-title">ADD NEW TATTOO</h2>
            <p class="form-subtitle">Upload a new masterpiece to the collection</p>

            {{-- 1. ERROR GENERAL (Ej: Fallo de conexión o Catch) --}}
            @if($errors->has('general'))
                <div style="background: #ff4d4d; color: white; padding: 10px; margin-bottom: 20px; border-radius: 5px; font-size: 0.9rem;">
                    {{ $errors->first('general') }}
                </div>
            @endif

            <form action="{{ route('tattoos.store') }}" method="POST" enctype="multipart/form-data" class="lunaink-form" novalidate>
                @csrf

                <div class="form-group">
                    <label for="title">Tattoo Title *</label>
                    {{-- 2. OLD VALUE --}}
                    <input type="text" name="title" id="title" class="form-input" 
                           placeholder="E.g. ETERNAL DRAGON"
                           value="{{ old('title') }}" required>
                    
                    {{-- 3. ERROR MESSAGE --}}
                    @error('title')
                        <span style="color: #ff4d4d; font-size: 0.8rem; display: block; margin-top: 5px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Tattoo Image *</label>
                    <div class="drop-zone" id="drop-zone">
                        <span class="drop-zone__prompt">
                            <div class="drop-icon"></div> Drag & Drop file here or <strong>Click to Upload</strong>
                            <br><small>(JPG, PNG - Max 2MB)</small>
                        </span>
                        
                        {{-- NOTA: Los inputs type="file" NO pueden tener 'value' por seguridad del navegador --}}
                        <input type="file" name="image" class="drop-zone__input" id="fileInput" accept="image/*" required>
                        
                        <div class="drop-zone__thumb" id="previewThumb"></div>
                    </div>
                    @error('image')
                        <span style="color: #ff4d4d; font-size: 0.8rem; display: block; margin-top: 5px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="artist_id">Artist *</label>
                    <select name="artist_id" id="artist_id" class="form-input form-select" required>
                        <option value="" disabled selected>SELECT AN ARTIST</option>
                        @foreach($artists as $artist)
                            {{-- 2. OLD VALUE PARA SELECT --}}
                            <option value="{{ $artist->id }}" {{ old('artist_id') == $artist->id ? 'selected' : '' }}>
                                {{ $artist->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('artist_id')
                        <span style="color: #ff4d4d; font-size: 0.8rem; display: block; margin-top: 5px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="duration">Duration</label>
                    {{-- 2. OLD VALUE --}}
                    <input type="text" name="duration" id="duration" class="form-input"
                           value="{{ old('duration') }}"
                           placeholder="E.g. 4 hours / 2 sessions">
                    
                    @error('duration')
                        <span style="color: #ff4d4d; font-size: 0.8rem; display: block; margin-top: 5px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="style_id">Style *</label>
                    <select name="style_id" id="style_id" class="form-input form-select" required>
                        <option value="" disabled selected>SELECT A STYLE</option>
                        @foreach($styles as $style)
                            {{-- 2. OLD VALUE PARA SELECT --}}
                            <option value="{{ $style->id }}" {{ old('style_id') == $style->id ? 'selected' : '' }}>
                                {{ $style->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('style_id')
                        <span style="color: #ff4d4d; font-size: 0.8rem; display: block; margin-top: 5px;">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn-submit">
                    UPLOAD TATTOO
                </button>
            </form>
        </div>
    </div>
@endsection