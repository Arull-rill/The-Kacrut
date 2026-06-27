@extends('layouts.frontend')

@section('title', 'Music — Band Website')

@section('styles')
<style>
    .music-hero {
        min-height: 50vh;
        display: flex;
        align-items: center;
        padding: 140px 60px 80px;
        background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%);
        position: relative;
    }

    .music-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse at right, rgba(201,168,76,0.06) 0%, transparent 60%);
    }

    /* ALBUM SECTION */
    .album-block {
        margin-bottom: 80px;
        padding-bottom: 80px;
        border-bottom: 1px solid rgba(255,255,255,0.06);
    }

    .album-header {
        display: grid;
        grid-template-columns: 200px 1fr;
        gap: 40px;
        align-items: start;
        margin-bottom: 40px;
    }

    .album-cover {
        width: 200px;
        height: 200px;
        background: var(--dark2);
        border: 1px solid rgba(201,168,76,0.15);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
        color: var(--gray);
        overflow: hidden;
        flex-shrink: 0;
    }

    .album-cover img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .album-meta-title {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 42px;
        letter-spacing: 3px;
        margin-bottom: 8px;
    }

    .album-year {
        font-size: 12px;
        letter-spacing: 3px;
        color: var(--gold);
        text-transform: uppercase;
        margin-bottom: 12px;
    }

    .album-desc {
        font-size: 13px;
        color: var(--gray);
        line-height: 1.8;
        max-width: 500px;
    }

    /* TRACK LIST */
    .track-list { list-style: none; }

    .track-item {
        display: flex;
        align-items: center;
        gap: 20px;
        padding: 16px 20px;
        border-bottom: 1px solid rgba(255,255,255,0.04);
        transition: background 0.2s ease;
        cursor: pointer;
    }

    .track-item:hover { background: var(--dark2); }

    .track-num {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 18px;
        color: var(--gray);
        width: 30px;
        text-align: center;
        flex-shrink: 0;
    }

    .track-item:hover .track-num { color: var(--gold); }

    .track-cover {
        width: 44px;
        height: 44px;
        background: var(--dark);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--gray);
        font-size: 18px;
        flex-shrink: 0;
        overflow: hidden;
    }

    .track-cover img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .track-info { flex: 1; }

    .track-title {
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 4px;
    }

    .track-album-name {
        font-size: 12px;
        color: var(--gray);
    }

    .track-links {
        display: flex;
        gap: 12px;
        flex-shrink: 0;
    }

    .track-links a {
        color: var(--gray);
        font-size: 18px;
        text-decoration: none;
        transition: color 0.2s;
    }

    .track-links a:hover { color: var(--gold); }

    /* SINGLES */
    .singles-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
        margin-top: 40px;
    }

    .single-card {
        background: var(--dark2);
        border: 1px solid rgba(255,255,255,0.04);
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .single-card:hover {
        border-color: rgba(201,168,76,0.3);
        transform: translateY(-4px);
    }

    .single-cover {
        aspect-ratio: 1;
        background: var(--dark);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
        color: var(--gray);
        overflow: hidden;
    }

    .single-cover img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .single-info { padding: 20px; }

    .single-title {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 20px;
        letter-spacing: 2px;
        margin-bottom: 12px;
    }

    .single-links {
        display: flex;
        gap: 12px;
    }

    .single-links a {
        color: var(--gray);
        font-size: 20px;
        text-decoration: none;
        transition: color 0.2s;
    }

    .single-links a:hover { color: var(--gold); }

    @media (max-width: 768px) {
        .music-hero { padding: 120px 24px 60px; }
        .album-header { grid-template-columns: 1fr; }
        .album-cover { width: 140px; height: 140px; }
        .singles-grid { grid-template-columns: 1fr; }
    }
</style>
@endsection

@section('content')

{{-- HERO --}}
<section class="music-hero">
    <div style="position:relative;z-index:1;">
        <div class="section-label">Discography</div>
        <h1 class="section-title" style="font-size:clamp(48px,8vw,100px);">Our Music</h1>
        <p class="section-desc">Semua karya kami, dari album hingga single.</p>
    </div>
</section>

{{-- ALBUMS --}}
@if($albums->count() > 0)
<section class="section">
    <div class="section-label">Albums</div>
    <h2 class="section-title">Discography</h2>

    @foreach($albums as $album)
        <div class="album-block">
            <div class="album-header">
                <div class="album-cover">
                    @if($album->cover)
                        <img src="{{ asset('storage/' . $album->cover) }}" alt="{{ $album->title }}">
                    @else
                        <i class="bi bi-vinyl"></i>
                    @endif
                </div>
                <div>
                    <div class="album-year">{{ $album->release_year ?? '—' }}</div>
                    <div class="album-meta-title">{{ $album->title }}</div>
                    @if($album->description)
                        <div class="album-desc">{{ $album->description }}</div>
                    @endif
                </div>
            </div>

            {{-- Track List --}}
            @if($album->musics->count() > 0)
                <ul class="track-list">
                    @foreach($album->musics as $i => $track)
                        <li class="track-item">
                            <div class="track-num">{{ $i + 1 }}</div>
                            <div class="track-cover">
                                @if($track->cover)
                                    <img src="{{ asset('storage/' . $track->cover) }}" alt="{{ $track->title }}">
                                @else
                                    <i class="bi bi-music-note"></i>
                                @endif
                            </div>
                            <div class="track-info">
                                <div class="track-title">{{ $track->title }}</div>
                                <div class="track-album-name">{{ $album->title }}</div>
                            </div>
                            <div class="track-links">
                                @if($track->spotify_embed)
                                    <a href="{{ $track->spotify_embed }}" target="_blank" title="Spotify">
                                        <i class="bi bi-spotify"></i>
                                    </a>
                                @endif
                                @if($track->youtube_embed)
                                    <a href="{{ $track->youtube_embed }}" target="_blank" title="YouTube">
                                        <i class="bi bi-youtube"></i>
                                    </a>
                                @endif
                                @if($track->apple_music_url)
                                    <a href="{{ $track->apple_music_url }}" target="_blank" title="Apple Music">
                                        <i class="bi bi-apple"></i>
                                    </a>
                                @endif
                                @if($track->is_downloadable && $track->audio_file)
                                    <a href="{{ asset('storage/' . $track->audio_file) }}" download title="Download">
                                        <i class="bi bi-download"></i>
                                    </a>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    @endforeach
</section>
@endif

{{-- SINGLES --}}
@php $singles = $musics->whereNull('album_id'); @endphp
@if($singles->count() > 0)
<section class="section" style="padding-top:0;">
    <div class="section-label">Singles</div>
    <h2 class="section-title">Singles</h2>

    <div class="singles-grid">
        @foreach($singles as $single)
            <div class="single-card">
                <div class="single-cover">
                    @if($single->cover)
                        <img src="{{ asset('storage/' . $single->cover) }}" alt="{{ $single->title }}">
                    @else
                        <i class="bi bi-music-note-beamed"></i>
                    @endif
                </div>
                <div class="single-info">
                    <div class="single-title">{{ $single->title }}</div>
                    <div class="single-links">
                        @if($single->spotify_embed)
                            <a href="{{ $single->spotify_embed }}" target="_blank"><i class="bi bi-spotify"></i></a>
                        @endif
                        @if($single->youtube_embed)
                            <a href="{{ $single->youtube_embed }}" target="_blank"><i class="bi bi-youtube"></i></a>
                        @endif
                        @if($single->apple_music_url)
                            <a href="{{ $single->apple_music_url }}" target="_blank"><i class="bi bi-apple"></i></a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
@endif

{{-- EMPTY STATE --}}
@if($musics->count() === 0 && $albums->count() === 0)
<section class="section" style="text-align:center;">
    <i class="bi bi-music-note-beamed" style="font-size:64px;color:var(--gray);display:block;margin-bottom:24px;"></i>
    <h2 class="section-title" style="font-size:36px;">Belum Ada Musik</h2>
    <p class="section-desc" style="margin:0 auto;">Tambahkan musik lewat Admin Panel.</p>
</section>
@endif

@endsection