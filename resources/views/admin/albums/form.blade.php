@extends('admin.layouts.admin')

@section('title', isset($album) ? 'Edit Album' : 'Tambah Album')

@section('content')

<div class="page-header">
    <div class="page-header-left">
        <div class="page-label">Albums</div>
        <h1>{{ isset($album) ? 'Edit Album' : 'Tambah Album' }}</h1>
    </div>
    <a href="{{ route('admin.albums.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div style="display:grid;grid-template-columns:2fr 1fr;gap:24px;">

    <div>
        <form method="POST"
              action="{{ isset($album) ? route('admin.albums.update', $album) : route('admin.albums.store') }}"
              enctype="multipart/form-data"
              id="albumForm">
            @csrf
            @if(isset($album)) @method('PUT') @endif

            <div class="card" style="margin-bottom:20px;">
                <div class="card-title">Informasi Album</div>

                <div class="form-group">
                    <label class="form-label">Judul Album *</label>
                    <input type="text" name="title" class="form-control"
                           value="{{ old('title', $album->title ?? '') }}"
                           placeholder="Judul album" required>
                    @error('title')
                        <div style="color:var(--danger);font-size:12px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Tahun Rilis</label>
                        <input type="number" name="release_year" class="form-control"
                               value="{{ old('release_year', $album->release_year ?? '') }}"
                               placeholder="2024" min="1900" max="2099">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="4"
                              placeholder="Cerita di balik album ini...">{{ old('description', $album->description ?? '') }}</textarea>
                </div>
            </div>

            <div style="display:flex;gap:12px;">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-lg"></i>
                    {{ isset($album) ? 'Update Album' : 'Simpan Album' }}
                </button>
                <a href="{{ route('admin.albums.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>

    <div>
        <div class="card">
            <div class="card-title">Cover Album</div>

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
                @if(isset($album) && $album->cover)
                    <img src="{{ asset('storage/' . $album->cover) }}"
                         style="width:100%;height:100%;object-fit:cover;">
                @else
                    <div id="coverPlaceholder" style="text-align:center;color:var(--gray);">
                        <i class="bi bi-image" style="font-size:40px;display:block;margin-bottom:8px;"></i>
                        <span style="font-size:12px;">Klik untuk upload cover</span>
                    </div>
                @endif
            </div>
            <p style="font-size:11px;color:var(--gray);text-align:center;">JPG, PNG. Rekomendasi 500x500px</p>
        </div>

        {{-- DAFTAR LAGU (kalau edit) --}}
        @if(isset($album) && $album->musics->count() > 0)
            <div class="card" style="margin-top:20px;">
                <div class="card-title">Lagu dalam Album</div>
                @foreach($album->musics as $i => $track)
                    <div style="display:flex;align-items:center;gap:12px;padding:10px 0;border-bottom:1px solid rgba(255,255,255,0.04);">
                        <span style="color:var(--gray);font-size:13px;width:20px;">{{ $i + 1 }}</span>
                        <span style="font-size:13px;">{{ $track->title }}</span>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</div>

<script>
    const form = document.getElementById('albumForm');
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
            document.getElementById('coverPreview').innerHTML =
                `<img src="${e.target.result}" style="width:100%;height:100%;object-fit:cover;">`;
        };
        reader.readAsDataURL(file);
    });
</script>

@endsection