@extends('layouts.frontend')

@section('title', 'About — Band Website')

@section('styles')
<style>
    .about-hero {
        min-height: 60vh;
        display: flex;
        align-items: center;
        background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%);
        position: relative;
        overflow: hidden;
        padding: 140px 60px 80px;
    }

    .about-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse at left, rgba(201,168,76,0.06) 0%, transparent 60%);
    }

    .about-hero-content { position: relative; z-index: 1; }

    /* STORY */
    .story-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 80px;
        align-items: center;
    }

    .story-text p {
        color: var(--gray);
        font-size: 14px;
        line-height: 2;
        margin-bottom: 20px;
    }

    .story-visual {
        aspect-ratio: 4/5;
        background: var(--dark2);
        border: 1px solid rgba(201,168,76,0.15);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 80px;
        color: rgba(201,168,76,0.2);
        position: relative;
    }

    .story-visual::after {
        content: '';
        position: absolute;
        bottom: -12px;
        right: -12px;
        width: 100%;
        height: 100%;
        border: 1px solid rgba(201,168,76,0.08);
        z-index: -1;
    }

    /* MEMBERS */
    .members-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
        margin-top: 60px;
    }

    .member-card {
        text-align: center;
        transition: transform 0.3s ease;
    }

    .member-card:hover { transform: translateY(-6px); }

    .member-photo {
        width: 100%;
        aspect-ratio: 1;
        background: var(--dark2);
        border: 1px solid rgba(255,255,255,0.06);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
        color: var(--gray);
        margin-bottom: 20px;
        overflow: hidden;
    }

    .member-photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .member-name {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 20px;
        letter-spacing: 2px;
        margin-bottom: 6px;
    }

    .member-role {
        font-size: 11px;
        letter-spacing: 3px;
        text-transform: uppercase;
        color: var(--gold);
    }

    /* ACHIEVEMENT */
    .achievement-list {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2px;
        margin-top: 60px;
    }

    .achievement-item {
        background: var(--dark2);
        padding: 40px;
        border: 1px solid rgba(255,255,255,0.04);
        position: relative;
        overflow: hidden;
    }

    .achievement-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 3px;
        height: 0;
        background: var(--gold);
        transition: height 0.3s ease;
    }

    .achievement-item:hover::before { height: 100%; }

    .achievement-year {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 48px;
        color: rgba(201,168,76,0.15);
        line-height: 1;
        margin-bottom: 12px;
    }

    .achievement-title {
        font-size: 15px;
        font-weight: 500;
        margin-bottom: 8px;
    }

    .achievement-desc {
        font-size: 13px;
        color: var(--gray);
        line-height: 1.7;
    }

    @media (max-width: 768px) {
        .about-hero { padding: 120px 24px 60px; }
        .story-grid { grid-template-columns: 1fr; gap: 40px; }
        .story-visual { display: none; }
        .members-grid { grid-template-columns: repeat(2, 1fr); }
        .achievement-list { grid-template-columns: 1fr; }
    }
</style>
@endsection

@section('content')

{{-- HERO --}}
<section class="about-hero">
    <div class="about-hero-content">
        <div class="section-label">Siapa Kami</div>
        <h1 class="section-title" style="font-size:clamp(48px,8vw,100px);">About Us</h1>
        <p class="section-desc">Perjalanan kami dimulai dari garasi kecil di Bandung, membawa cerita lewat musik.</p>
    </div>
</section>

{{-- STORY --}}
<section class="section">
    <div class="story-grid">
        <div class="story-text">
            <div class="section-label">Cerita Kami</div>
            <h2 class="section-title" style="font-size:42px;">The Story</h2>
            <p>Dibentuk pada tahun 2020 di Bandung, kami adalah sekelompok musisi muda yang menyatukan jiwa dalam satu visi: menciptakan musik yang jujur dan penuh makna.</p>
            <p>Perjalanan kami dimulai dari panggung kecil, café, hingga festival musik. Setiap penampilan adalah cerita baru, setiap lagu adalah ekspresi terdalam yang kami tawarkan kepada dunia.</p>
            <p>Kami percaya bahwa musik adalah jembatan antara perasaan yang tak terucapkan dengan jiwa yang mendengarkan.</p>
            <a href="{{ route('music') }}" class="btn-gold" style="margin-top:20px;">Dengarkan Musik Kami</a>
        </div>
        <div class="story-visual">
            <i class="bi bi-music-note-beamed"></i>
        </div>
    </div>
</section>

<hr class="divider">

{{-- MEMBERS --}}
<section class="section">
    <div class="section-label">Tim Kami</div>
    <h2 class="section-title">The Members</h2>

    <div class="members-grid">
        {{-- Nanti bisa diambil dari database, sekarang static dulu --}}
        @php
            $members = [
                ['name' => 'Rizky', 'role' => 'Vocalist', 'icon' => 'bi-mic'],
                ['name' => 'Dimas', 'role' => 'Guitarist', 'icon' => 'bi-music-note'],
                ['name' => 'Fajar', 'role' => 'Bassist', 'icon' => 'bi-soundwave'],
                ['name' => 'Andi', 'role' => 'Drummer', 'icon' => 'bi-speaker'],
            ];
        @endphp

        @foreach($members as $member)
            <div class="member-card">
                <div class="member-photo">
                    <i class="{{ $member['icon'] }}"></i>
                </div>
                <div class="member-name">{{ $member['name'] }}</div>
                <div class="member-role">{{ $member['role'] }}</div>
            </div>
        @endforeach
    </div>
</section>

<hr class="divider">

{{-- ACHIEVEMENT --}}
<section class="section">
    <div class="section-label">Pencapaian</div>
    <h2 class="section-title">Achievement</h2>

    <div class="achievement-list">
        @php
            $achievements = [
                ['year' => '2021', 'title' => 'Debut Single', 'desc' => 'Merilis single perdana yang mendapat sambutan luar biasa dari pendengar Bandung.'],
                ['year' => '2022', 'title' => 'Festival Musik Bandung', 'desc' => 'Tampil di salah satu festival musik terbesar di Jawa Barat dengan ribuan penonton.'],
                ['year' => '2023', 'title' => 'Album Pertama', 'desc' => 'Merilis album penuh pertama bertajuk "Sunyi" yang tersedia di semua platform streaming.'],
                ['year' => '2023', 'title' => '1 Juta Streams', 'desc' => 'Mencapai 1 juta total streams di Spotify untuk lagu-lagu dari album perdana.'],
                ['year' => '2024', 'title' => 'Tur Jawa', 'desc' => 'Menyelesaikan tur 10 kota di Pulau Jawa dengan total 5.000 penonton.'],
                ['year' => '2025', 'title' => 'Album Kedua', 'desc' => 'Dalam proses rekaman album kedua yang lebih matang dan eksperimental.'],
            ];
        @endphp

        @foreach($achievements as $item)
            <div class="achievement-item">
                <div class="achievement-year">{{ $item['year'] }}</div>
                <div class="achievement-title">{{ $item['title'] }}</div>
                <div class="achievement-desc">{{ $item['desc'] }}</div>
            </div>
        @endforeach
    </div>
</section>

@endsection