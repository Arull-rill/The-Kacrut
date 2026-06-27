@extends('admin.layouts.admin')

@section('title', isset($music) ? 'Edit Lagu' : 'Tambah Lagu')

@section('content')

<div class="page-header">
    <div class="page-header-left">
        <div class="page-label">Music</div>
        <h1>{{ isset($music) ? 'Edit Lagu' : 'Tambah Lagu' }}</h1>
    </div>
    <a href="{{ route('admin.music.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div style="display:grid;grid-template-columns:2fr 1fr;gap:24px;">

    {{-- FORM UTAMA --}}
    <div>
        <form method="POST"
              action="{{ isset($music) ? route('admin.music.update', $music) : route('admin.music.store') }}"
              enctype="multipart/form-data">
            @csrf
            @if(isset($music)) @method('PUT') @endif

            <div class="card" style="margin-bottom:20px;">
                <div class="card-title">Informasi Lagu</div>

                <div class="form-group">
                    <label class="form-label">Judul Lagu *</label>
                    <input type="text" name="title" class="form-control"
                           value="{{ old('title', $music->title ?? '') }}"
                           placeholder="Judul lagu" required>
                    @error('title')
                        <div style="color:var(--danger);font-size:12px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Album</label>
                    <select name="album_id" class="form-control">
                        <option value="">— Single (tanpa album) —</option>
                        @foreach($albums as $album)
                            <option value="{{ $album->id }}"
                                {{ old('album_id', $music->album_id ?? '') == $album->id ? 'selected' : '' }}>
                                {{ $album->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Upload Audio (MP3/WAV)</label>
                    <input type="file" name="audio_file" class="form-control" accept="audio/*">
                    @if(isset($music) && $music->audio_file)
                        <div style="margin-top:8px;font-size:12px;color:var(--gold);">
                            <i class="bi bi-file-music"></i> File audio tersimpan
                        </div>
                    @endif
                    <div class="form-hint">Max 20MB. Format: MP3, WAV, OGG</div>
                </div>

                <div class="form-group">
                    <label class="form-label" style="display:flex;align-items:center;gap:8px;cursor:pointer;">
                        <input type="checkbox" name="is_downloadable" value="1"
                               {{ old('is_downloadable', $music->is_downloadable ?? false) ? 'checked' : '' }}
                               style="width:16px;height:16px;accent-color:var(--gold);">
                        Bisa didownload pengunjung
                    </label>
                </div>
            </div>

            <div class="card" style="margin-bottom:20px;">
                <div class="card-title">Link Platform</div>

                <div class="form-group">
                    <label class="form-label"><i class="bi bi-spotify" style="color:var(--success);"></i> Spotify URL</label>
                    <input type="url" name="spotify_embed" class="form-control"
                           value="{{ old('spotify_embed', $music->spotify_embed ?? '') }}"
                           placeholder="https://open.spotify.com/track/...">
                </div>

                <div class="form-group">
                    <label class="form-label"><i class="bi bi-youtube" style="color:var(--danger);"></i> YouTube URL</label>
                    <input type="url" name="youtube_embed" class="form-control"
                           value="{{ old('youtube_embed', $music->youtube_embed ?? '') }}"
                           placeholder="https://youtube.com/watch?v=...">
                </div>

                <div class="form-group">
                    <label class="form-label"><i class="bi bi-apple"></i> Apple Music URL</label>
                    <input type="url" name="apple_music_url" class="form-control"
                           value="{{ old('apple_music_url', $music->apple_music_url ?? '') }}"
                           placeholder="https://music.apple.com/...">
                </div>
            </div>

            <div style="display:flex;gap:12px;">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-lg"></i>
                    {{ isset($music) ? 'Update Lagu' : 'Simpan Lagu' }}
                </button>
                <a href="{{ route('admin.music.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>

    {{-- COVER UPLOAD --}}
    <div>
        <div class="card">
            <div class="card-title">Cover Lagu</div>

            <div id="coverPreview" style="
                width:100%;
                aspect-ratio:1;
                background:var(--dark3);
                border:2px dashed rgba(255,255,255,0.1);
                display:flex;
                align-items:center;
                justify-content:center;
                margin-bottom:16px;
                overflow:hidden;
                cursor:pointer;
            " onclick="document.getElementById('coverInput').click()">
                @if(isset($music) && $music->cover)
                    <img id="coverImg"
                         src="{{ asset('storage/' . $music->cover) }}"
                         style="width:100%;height:100%;object-fit:cover;">
                @else
                    <div id="coverPlaceholder" style="text-align:center;color:var(--gray);">
                        <i class="bi bi-image" style="font-size:40px;display:block;margin-bottom:8px;"></i>
                        <span style="font-size:12px;">Klik untuk upload cover</span>
                    </div>
                @endif
            </div>

            {{-- Input file cover diletakkan di dalam form utama --}}
            <p style="font-size:11px;color:var(--gray);text-align:center;">
                JPG, PNG. Rekomendasi 500x500px
            </p>
        </div>
    </div>

</div>

{{-- Tambahkan input cover ke dalam form --}}
<script>
    // Inject input file cover ke dalam form
    const form = document.querySelector('form');
    const coverInput = document.createElement('input');
    coverInput.type = 'file';
    coverInput.name = 'cover';
    coverInput.id = 'coverInput';
    coverInput.accept = 'image/*';
    coverInput.style.display = 'none';
    form.appendChild(coverInput);

    coverInput.addEventListener('change', function() {
        const file = this.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('coverPreview');
            preview.innerHTML = `<img id="coverImg" src="${e.target.result}" style="width:100%;height:100%;object-fit:cover;">`;
        };
        reader.readAsDataURL(file);
    });
</script>

@endsection