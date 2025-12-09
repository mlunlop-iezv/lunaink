@extends('layouts.app')

@section('content')
    <div class="form-wrapper">
        <div class="form-card">
            <div class="nav-back">
                <a href="{{ route('tattoos.index') }}" class="back-link">
                    <span class="arrow">←</span> BACK TO GALLERY
                </a>
            </div>

            <h2 class="form-title">EDIT TATTOO</h2>
            <p class="form-subtitle">Update the details of this masterpiece</p>

            {{-- CAMBIO: Mensaje de error general --}}
            @if($errors->has('general'))
                <div style="background: #ff4d4d; color: white; padding: 10px; margin-bottom: 15px; border-radius: 5px;">
                    {{ $errors->first('general') }}
                </div>
            @endif

            <form action="{{ route('tattoos.update', $tattoo) }}" method="POST" enctype="multipart/form-data" class="lunaink-form" novalidate>
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="title">Tattoo Title</label>
                    {{-- CAMBIO: old('title', $tattoo->title) --}}
                    <input type="text" name="title" id="title" class="form-input" value="{{ old('title', $tattoo->title) }}"
                        required>

                    @error('title')
                        <span style="color: #ff4d4d; font-size: 0.8rem; display: block; margin-top: 5px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Tattoo Image (Leave empty to keep current)</label>
                    <div class="drop-zone" id="drop-zone">
                        <span class="drop-zone__prompt">
                            <div class="drop-icon"></div> Drag & Drop file to replace or <strong>Click to Upload</strong>
                            <br><small>(JPG, PNG - Max 5MB)</small>
                        </span>

                        <input type="file" name="image" class="drop-zone__input" id="fileInput" accept="image/*">

                        <div class="drop-zone__thumb" id="previewThumb"
                            style="display: block; background-image: url('{{ $tattoo->getPath() }}');">
                        </div>
                    </div>
                    @error('image')
                        <span style="color: #ff4d4d; font-size: 0.8rem; display: block; margin-top: 5px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="artist_id">Artist</label>
                    <select name="artist_id" id="artist_id" class="form-input form-select" required>
                        <option value="" disabled>SELECT AN ARTIST</option>
                        @foreach($artists as $artist)
                            {{-- CAMBIO: Lógica doble para old o DB --}}
                            <option value="{{ $artist->id }}" {{ old('artist_id', $tattoo->artist_id) == $artist->id ? 'selected' : '' }}>
                                {{ $artist->name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="select-arrow">▼</div>
                    @error('artist_id')
                        <span style="color: #ff4d4d; font-size: 0.8rem; display: block; margin-top: 5px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="duration">Duration</label>
                    {{-- CAMBIO: old('duration', $tattoo->duration) --}}
                    <input type="text" name="duration" id="duration" class="form-input"
                        value="{{ old('duration', $tattoo->duration) }}" placeholder="E.g. 4 hours / 2 sessions">

                    @error('duration')
                        <span style="color: #ff4d4d; font-size: 0.8rem; display: block; margin-top: 5px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="style_id">Style</label>
                    <select name="style_id" id="style_id" class="form-input form-select" required>
                        <option value="" disabled>SELECT A STYLE</option>
                        @foreach($styles as $style)
                            {{-- CAMBIO: Lógica doble --}}
                            <option value="{{ $style->id }}" {{ old('style_id', $tattoo->style_id) == $style->id ? 'selected' : '' }}>
                                {{ $style->name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="select-arrow">▼</div>
                    @error('style_id')
                        <span style="color: #ff4d4d; font-size: 0.8rem; display: block; margin-top: 5px;">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn-submit">
                    UPDATE TATTOO
                </button>
            </form>
        </div>
    </div>
@endsection