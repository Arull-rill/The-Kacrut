@extends('admin.layouts.admin')

@section('title', 'Music')

@section('content')

<div class="page-header">
    <div class="page-header-left">
        <div class="page-label">Konten</div>
        <h1>Music</h1>
    </div>
    <a href="{{ route('admin.music.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Tambah Lagu
    </a>
</div>

<div class="card">
    @if($musics->count() > 0)
        <table class="admin-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Cover</th>
                    <th>Judul</th>
                    <th>Album</th>
                    <th>Platform</th>
                    <th>Download</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($musics as $i => $music)
                    <tr>
                        <td style="color:var(--gray);">{{ $i + 1 }}</td>
                        <td>
                            <div style="width:44px;height:44px;background:var(--dark3);display:flex;align-items:center;justify-content:center;overflow:hidden;">
                                @if($music->cover)
                                    <img src="{{ asset('storage/' . $music->cover) }}" style="width:100%;height:100%;object-fit:cover;">
                                @else
                                    <i class="bi bi-music-note" style="color:var(--gray);"></i>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div style="font-weight:500;">{{ $music->title }}</div>
                        </td>
                        <td>
                            <span class="badge badge-gold">{{ $music->album->title ?? 'Single' }}</span>
                        </td>
                        <td>
                            <div style="display:flex;gap:10px;">
                                @if($music->spotify_embed)
                                    <i class="bi bi-spotify" style="color:var(--success);" title="Spotify"></i>
                                @endif
                                @if($music->youtube_embed)
                                    <i class="bi bi-youtube" style="color:var(--danger);" title="YouTube"></i>
                                @endif
                                @if($music->apple_music_url)
                                    <i class="bi bi-apple" style="color:var(--gray-light);" title="Apple Music"></i>
                                @endif
                            </div>
                        </td>
                        <td>
                            @if($music->is_downloadable)
                                <span class="badge badge-success">Ya</span>
                            @else
                                <span class="badge badge-gray">Tidak</span>
                            @endif
                        </td>
                        <td>
                            <div style="display:flex;gap:8px;">
                                <a href="{{ route('admin.music.edit', $music) }}" class="btn btn-secondary btn-sm">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.music.destroy', $music) }}"
                                      onsubmit="return confirm('Hapus lagu ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div style="text-align:center;padding:60px;color:var(--gray);">
            <i class="bi bi-music-note-beamed" style="font-size:48px;display:block;margin-bottom:16px;"></i>
            <p>Belum ada lagu. Yuk tambahkan!</p>
            <a href="{{ route('admin.music.create') }}" class="btn btn-primary" style="margin-top:16px;">
                <i class="bi bi-plus-lg"></i> Tambah Lagu
            </a>
        </div>
    @endif
</div>

@endsection