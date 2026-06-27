@extends('layouts.frontend')

@section('title', 'Gallery — Band Website')

@section('styles')
<style>
    .gallery-hero {
        min-height: 50vh;
        display: flex;
        align-items: center;
        padding: 140px 60px 80px;
        background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%);
    }

    .filter-tabs {
        display: flex;
        gap: 4px;
        margin-bottom: 48px;
    }

    .filter-tab {
        padding: 10px 28px;
        font-size: 11px;
        letter-spacing: 2px;
        text-transform: uppercase;
        background: none;
        border: 1px solid rgba(255,255,255,0.1);
        color: var(--gray);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .filter-tab.active,
    .filter-tab:hover {
        background: var(--gold);
        border-color: var(--gold);
        color: var(--black);
    }

    .gallery-masonry {
        columns: 3;
        column-gap: 4px;
    }

    .gallery-masonry-item {
        break-inside: avoid;
        margin-bottom: 4px;
        overflow: hidden;
        position: relative;
        cursor: pointer;
    }

    .gallery-masonry-item img {
        width: 100%;
        display: block;
        transition: transform 0.5s ease;
    }

    .gallery-masonry-item:hover img {
        transform: scale(1.05);
    }

    .gallery-masonry-item .overlay {
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0.5);
        opacity: 0;
        transition: opacity 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        color: var(--white);
    }

    .gallery-masonry-item:hover .overlay {
        opacity: 1;
    }

    .gallery-placeholder-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 4px;
    }

    .gallery-placeholder-item {
        aspect-ratio: 1;
        background: var(--dark2);
        border: 1px solid rgba(255,255,255,0.04);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 40px;
        color: rgba(255,255,255,0.1);
    }

    /* VIDEO GRID */
    .video-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 24px;
        margin-top: 40px;
    }

    .video-card {
        background: var(--dark2);
        border: 1px solid rgba(255,255,255,0.04);
        overflow: hidden;
    }

    .video-thumb {
        aspect-ratio: 16/9;
        background: var(--dark);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
        color: var(--gray);
        position: relative;
        overflow: hidden;
    }

    .video-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .video-info {
        padding: 16px 20px;
        font-size: 14px;
        font-weight: 500;
    }

    .video-category {
        font-size: 11px;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: var(--gold);
        margin-top: 4px;
    }

    /* LIGHTBOX */
    .lightbox {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.95);
        z-index: 9999;
        align-items: center;
        justify-content: center;
    }

    .lightbox.open { display: flex; }

    .lightbox img {
        max-width: 90vw;
        max-height: 90vh;
        object-fit: contain;
    }

    .lightbox-close {
        position: absolute;
        top: 24px;
        right: 32px;
        font-size: 32px;
        color: var(--white);
        cursor: pointer;
        background: none;
        border: none;
        line-height: 1;
    }

    @media (max-width: 768px) {
        .gallery-hero { padding: 120px 24px 60px; }
        .gallery-masonry { columns: 2; }
        .video-grid { grid-template-columns: 1fr; }
        .gallery-placeholder-grid { grid-template-columns: repeat(2, 1fr); }
    }
</style>
@endsection

@section('content')

{{-- HERO --}}
<section class="gallery-hero">
    <div>
        <div class="section-label">Visual</div>
        <h1 class="section-title" style="font-size:clamp(48px,8vw,100px);">Gallery</h1>
        <p class="section-desc">Momen-momen berharga perjalanan kami.</p>
    </div>
</section>

{{-- PHOTOS --}}
<section class="section">
    <div class="section-label">Foto</div>
    <h2 class="section-title">Photos</h2>

    <div class="filter-tabs">
        <button class="filter-tab active" onclick="filterGallery('all', this)">Semua</button>
        <button class="filter-tab" onclick="filterGallery('event', this)">Event</button>
        <button class="filter-tab" onclick="filterGallery('behind_the_scene', this)">Behind The Scene</button>
        <button class="filter-tab" onclick="filterGallery('other', this)">Other</button>
    </div>

    @if($photos->count() > 0)
        <div class="gallery-masonry" id="galleryContainer">
            @foreach($photos as $photo)
                <div class="gallery-masonry-item" data-category="{{ $photo->category }}" onclick="openLightbox('{{ asset('storage/' . $photo->file) }}')">
                    <img src="{{ asset('storage/' . $photo->file) }}" alt="{{ $photo->title ?? 'Gallery' }}">
                    <div class="overlay"><i class="bi bi-zoom-in"></i></div>
                </div>
            @endforeach
        </div>
    @else
        <div class="gallery-placeholder-grid">
            @for($i = 0; $i < 6; $i++)
                <div class="gallery-placeholder-item">
                    <i class="bi bi-image"></i>
                </div>
            @endfor
        </div>
        <p style="text-align:center;color:var(--gray);margin-top:32px;font-size:13px;">Belum ada foto. Tambahkan lewat Admin Panel.</p>
    @endif
</section>

<hr class="divider">

{{-- VIDEOS --}}
<section class="section" style="padding-top:0;">
    <div class="section-label">Video</div>
    <h2 class="section-title">Videos</h2>

    @if($videos->count() > 0)
        <div class="video-grid">
            @foreach($videos as $video)
                <div class="video-card">
                    <div class="video-thumb">
                        @if($video->file)
                            <img src="{{ asset('storage/' . $video->file) }}" alt="{{ $video->title }}">
                        @else
                            <i class="bi bi-play-circle"></i>
                        @endif
                    </div>
                    <div class="video-info">
                        <div>{{ $video->title ?? 'Untitled' }}</div>
                        <div class="video-category">{{ ucfirst(str_replace('_', ' ', $video->category)) }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p style="color:var(--gray);font-size:13px;">Belum ada video.</p>
    @endif
</section>

{{-- LIGHTBOX --}}
<div class="lightbox" id="lightbox" onclick="closeLightbox()">
    <button class="lightbox-close" onclick="closeLightbox()">
        <i class="bi bi-x"></i>
    </button>
    <img src="" id="lightboxImg" alt="">
</div>

@endsection

@section('scripts')
<script>
    function openLightbox(src) {
        document.getElementById('lightboxImg').src = src;
        document.getElementById('lightbox').classList.add('open');
    }

    function closeLightbox() {
        document.getElementById('lightbox').classList.remove('open');
    }

    function filterGallery(category, btn) {
        document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
        btn.classList.add('active');

        document.querySelectorAll('.gallery-masonry-item').forEach(item => {
            if (category === 'all' || item.dataset.category === category) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }
</script>
@endsection