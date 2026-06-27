@extends('admin.layouts.admin')

@section('title', 'Albums')

@section('content')

<div class="page-header">
    <div class="page-header-left">
        <div class="page-label">Konten</div>
        <h1>Albums</h1>
    </div>
    <a href="{{ route('admin.albums.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Tambah Album
    </a>
</div>

<div class="card">
    @if($albums->count() > 0)
        <table class="admin-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Cover</th>
                    <th>Judul Album</th>
                    <th>Tahun</th>
                    <th>Jumlah Lagu</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($albums as $i => $album)
                    <tr>
                        <td style="color:var(--gray);">{{ $i + 1 }}</td>
                        <td>
                            <div style="width:44px;height:44px;background:var(--dark3);display:flex;align-items:center;justify-content:center;overflow:hidden;">
                                @if($album->cover)
                                    <img src="{{ asset('storage/' . $album->cover) }}" style="width:100%;height:100%;object-fit:cover;">
                                @else
                                    <i class="bi bi-vinyl" style="color:var(--gray);"></i>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div style="font-weight:500;">{{ $album->title }}</div>
                            @if($album->description)
                                <div style="font-size:12px;color:var(--gray);">{{ Str::limit($album->description, 40) }}</div>
                            @endif
                        </td>
                        <td>
                            <span class="badge badge-gold">{{ $album->release_year ?? '—' }}</span>
                        </td>
                        <td>
                            <span class="badge badge-info">{{ $album->musics->count() }} lagu</span>
                        </td>
                        <td>
                            <div style="display:flex;gap:8px;">
                                <a href="{{ route('admin.albums.edit', $album) }}" class="btn btn-secondary btn-sm">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.albums.destroy', $album) }}"
                                      onsubmit="return confirm('Hapus album ini? Lagu di dalamnya tidak akan terhapus.')">
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
            <i class="bi bi-vinyl" style="font-size:48px;display:block;margin-bottom:16px;"></i>
            <p>Belum ada album. Yuk tambahkan!</p>
            <a href="{{ route('admin.albums.create') }}" class="btn btn-primary" style="margin-top:16px;">
                <i class="bi bi-plus-lg"></i> Tambah Album
            </a>
        </div>
    @endif
</div>

@endsection