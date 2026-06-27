@extends('layouts.frontend')

@section('title', 'Home — Band Website')

@section('styles')
<style>
    /* HERO */
    .hero {
        height: 100vh;
        background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 50%, #0d0d0d 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse at center, rgba(201,168,76,0.08) 0%, transparent 70%);
    }

    .hero-eyebrow {
        font-size: 11px;
        letter-spacing: 6px;
        text-transform: uppercase;
        color: var(--gold);
        margin-bottom: 24px;
    }

    .hero-title {
        font-family: 'Bebas Neue', sans-serif;
        font-size: clamp(72px, 12vw, 160px);
        letter-spacing: 8px;
        line-height: 0.9;
        margin-bottom: 32px;
    }

    .hero-title span {
        display: block;
        color: var(--gold);
    }

    .hero-sub {
        color: var(--gray);
        font-size: 14px;
        letter-spacing: 2px;
        margin-bottom: 48px;
        max-width: 400px;
        margin-left: auto;
        margin-right: auto;
    }

    .hero-buttons {
        display: flex;
        gap: 16px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .hero-scroll {
        position: absolute;
        bottom: 40px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
        color: var(--gray);
        font-size: 10px;
        letter-spacing: 3px;
        text-transform: uppercase;
        animation: bounce 2s infinite;
    }

    @keyframes bounce {
        0%, 100% { transform: translateX(-50%) translateY(0); }
        50% { transform: translateX(-50%) translateY(8px); }
    }

    /* LATEST MUSIC */
    .music-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2px;
        margin-top: 60px;
    }

    .music-card {
        background: var(--dark2);
        padding: 32px;
        border: 1px solid rgba(255,255,255,0.04);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .music-card::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 2px;
        background: var(--gold);
        transition: width 0.3s ease;
    }

    .music-card:hover::before {
        width: 100%;
    }

    .music-card:hover {
        background: #1f1f1f;
    }

    .music-cover {
        width: 100%;
        aspect-ratio: 1;
        object-fit: cover;
        margin-bottom: 20px;
        background: var(--dark);
    }

    .music-cover-placeholder {
        width: 100%;
        aspect-ratio: 1;
        background: var(--dark);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        font-size: 48px;
        color: var(--gray);
    }

    .music-title {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 22px;
        letter-spacing: 2px;
        margin-bottom: 8px;
    }

    .music-album {
        font-size: 12px;
        color: var(--gold);
        letter-spacing: 1px;
    }

    /* GALLERY PREVIEW */
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 4px;
        margin-top: 60px;
    }

    .gallery-item {
        aspect-ratio: 1;
        background: var(--dark2);
        overflow: hidden;
        position: relative;
    }

    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .gallery-item:hover img {
        transform: scale(1.05);
    }

    .gallery-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--gray);
        font-size: 32px;
    }

    /* MERCH PREVIEW */
    .merch-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
        margin-top: 60px;
    }

    .merch-card {
        background: var(--dark2);
        border: 1px solid rgba(255,255,255,0.04);
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .merch-card:hover {
        border-color: rgba(201,168,76,0.3);
        transform: translateY(-4px);
    }

    .merch-image {
        aspect-ratio: 1;
        background: var(--dark);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--gray);
        font-size: 40px;
    }

    .merch-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .merch-info {
        padding: 20px;
    }

    .merch-name {
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 8px;
    }

    .merch-price {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 20px;
        color: var(--gold);
        letter-spacing: 1px;
    }

    /* SECTION CTA */
    .section-cta {
        text-align: center;
        margin-top: 60px;
    }

    .divider {
        border: none;
        border-top: 1px solid rgba(255,255,255,0.06);
    }

    @media (max-width: 768px) {
        .music-grid { grid-template-columns: 1fr; }
        .gallery-grid { grid-template-columns: repeat(2, 1fr); }
        .merch-grid { grid-template-columns: repeat(2, 1fr); }
    }
</style>
@endsection

@section('content')

{{-- HERO --}}
<section class="hero">
    <div>
        <div class="hero-eyebrow">Est. 2020 — Bandung, Indonesia</div>
        <h1 class="hero-title">
            KAMI ADALAH
            <span>THE KACRUT</span>
        </h1>
        <p class="hero-sub">Setiap lagu adalah cerita. Setiap nada adalah jiwa kami.</p>
        <div class="hero-buttons">
            <a href="{{ route('music') }}" class="btn-gold">Dengarkan Musik</a>
            <a href="{{ route('about') }}" class="btn-outline">Tentang Kami</a>
        </div>
    </div>
    <div class="hero-scroll">
        <i class="bi bi-chevron-down" style="font-size:18px;"></i>
        <span>Scroll</span>
    </div>
</section>

{{-- LATEST MUSIC --}}
<section class="section">
    <div class="section-label">Terbaru</div>
    <div style="display:flex;align-items:flex-end;justify-content:space-between;flex-wrap:wrap;gap:16px;">
        <h2 class="section-title">Latest Music</h2>
        <a href="{{ route('music') }}" class="btn-outline" style="margin-bottom:20px;">Lihat Semua</a>
    </div>

    <div class="music-grid">
        @forelse($latestMusics as $music)
            <div class="music-card">
                @if($music->cover)
                    <img src="{{ asset('storage/' . $music->cover) }}" alt="{{ $music->title }}" class="music-cover">
                @else
                    <div class="music-cover-placeholder">
                        <i class="bi bi-music-note"></i>
                    </div>
                @endif
                <div class="music-title">{{ $music->title }}</div>
                <div class="music-album">{{ $music->album->title ?? 'Single' }}</div>
            </div>
        @empty
            <div class="music-card" style="grid-column:1/-1;text-align:center;padding:60px;color:var(--gray);">
                <i class="bi bi-music-note-beamed" style="font-size:48px;display:block;margin-bottom:16px;"></i>
                Belum ada musik. Tambahkan lewat Admin Panel.
            </div>
        @endforelse
    </div>
</section>

<hr class="divider">

{{-- GALLERY PREVIEW --}}
<section class="section">
    <div class="section-label">Momen</div>
    <div style="display:flex;align-items:flex-end;justify-content:space-between;flex-wrap:wrap;gap:16px;">
        <h2 class="section-title">Gallery</h2>
        <a href="{{ route('gallery') }}" class="btn-outline" style="margin-bottom:20px;">Lihat Semua</a>
    </div>

    <div class="gallery-grid">
        @forelse($galleries as $item)
            <div class="gallery-item">
                @if($item->file)
                    <img src="{{ asset('storage/' . $item->file) }}" alt="{{ $item->title }}">
                @else
                    <div class="gallery-placeholder"><i class="bi bi-image"></i></div>
                @endif
            </div>
        @empty
            @for($i = 0; $i < 6; $i++)
                <div class="gallery-item">
                    <div class="gallery-placeholder"><i class="bi bi-image"></i></div>
                </div>
            @endfor
        @endforelse
    </div>
</section>

<hr class="divider">

{{-- MERCH PREVIEW --}}
<section class="section">
    <div class="section-label">Official Store</div>
    <div style="display:flex;align-items:flex-end;justify-content:space-between;flex-wrap:wrap;gap:16px;">
        <h2 class="section-title">Merchandise</h2>
        <a href="{{ route('merchandise') }}" class="btn-outline" style="margin-bottom:20px;">Lihat Semua</a>
    </div>

    <div class="merch-grid">
        @forelse($merchandises as $merch)
            <div class="merch-card">
                <div class="merch-image">
                    @if($merch->image)
                        <img src="{{ asset('storage/' . $merch->image) }}" alt="{{ $merch->name }}">
                    @else
                        <i class="bi bi-bag"></i>
                    @endif
                </div>
                <div class="merch-info">
                    <div class="merch-name">{{ $merch->name }}</div>
                    <div class="merch-price">Rp {{ number_format($merch->price, 0, ',', '.') }}</div>
                </div>
            </div>
        @empty
            <div style="grid-column:1/-1;text-align:center;padding:60px;color:var(--gray);">
                <i class="bi bi-bag" style="font-size:48px;display:block;margin-bottom:16px;"></i>
                Belum ada merchandise.
            </div>
        @endforelse
    </div>
</section>

@endsection

@section('scripts')
<script>
    // Fade in on scroll
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.music-card, .merch-card, .gallery-item').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        observer.observe(el);
    });
</script>
@endsection