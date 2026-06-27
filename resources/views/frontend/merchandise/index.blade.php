@extends('layouts.frontend')

@section('title', 'Merchandise — Band Website')

@section('styles')
<style>
    .merch-hero {
        min-height: 50vh;
        display: flex;
        align-items: center;
        padding: 140px 60px 80px;
        background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%);
    }

    .merch-filter {
        display: flex;
        gap: 4px;
        margin-bottom: 48px;
        flex-wrap: wrap;
    }

    .merch-filter-btn {
        padding: 10px 24px;
        font-size: 11px;
        letter-spacing: 2px;
        text-transform: uppercase;
        background: none;
        border: 1px solid rgba(255,255,255,0.1);
        color: var(--gray);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .merch-filter-btn.active,
    .merch-filter-btn:hover {
        background: var(--gold);
        border-color: var(--gold);
        color: var(--black);
    }

    .merch-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
    }

    .merch-card {
        background: var(--dark2);
        border: 1px solid rgba(255,255,255,0.04);
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .merch-card:hover {
        border-color: rgba(201,168,76,0.3);
        transform: translateY(-6px);
    }

    .merch-img {
        aspect-ratio: 1;
        background: var(--dark);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 56px;
        color: var(--gray);
        overflow: hidden;
        position: relative;
    }

    .merch-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .merch-card:hover .merch-img img {
        transform: scale(1.05);
    }

    .merch-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        background: var(--gold);
        color: var(--black);
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        padding: 4px 10px;
    }

    .merch-body { padding: 20px; }

    .merch-cat {
        font-size: 10px;
        letter-spacing: 3px;
        text-transform: uppercase;
        color: var(--gold);
        margin-bottom: 8px;
    }

    .merch-name {
        font-size: 15px;
        font-weight: 500;
        margin-bottom: 8px;
        line-height: 1.4;
    }

    .merch-desc {
        font-size: 12px;
        color: var(--gray);
        margin-bottom: 16px;
        line-height: 1.6;
    }

    .merch-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
    }

    .merch-price {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 22px;
        color: var(--gold);
        letter-spacing: 1px;
    }

    .merch-stock {
        font-size: 11px;
        color: var(--gray);
        letter-spacing: 1px;
    }

    .btn-order {
        display: inline-block;
        background: var(--gold);
        color: var(--black);
        padding: 8px 18px;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        text-decoration: none;
        transition: background 0.3s ease;
        white-space: nowrap;
        border: none;
        cursor: pointer;
    }

    .btn-order:hover { background: var(--gold-light); }

    @media (max-width: 768px) {
        .merch-hero { padding: 120px 24px 60px; }
        .merch-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 480px) {
        .merch-grid { grid-template-columns: 1fr; }
    }
</style>
@endsection

@section('content')

{{-- HERO --}}
<section class="merch-hero">
    <div>
        <div class="section-label">Official Store</div>
        <h1 class="section-title" style="font-size:clamp(48px,8vw,100px);">Merchandise</h1>
        <p class="section-desc">Koleksi merchandise resmi kami. Tunjukkan dukungan kamu.</p>
    </div>
</section>

{{-- MERCH --}}
<section class="section">
    <div class="merch-filter">
        <button class="merch-filter-btn active" onclick="filterMerch('all', this)">Semua</button>
        <button class="merch-filter-btn" onclick="filterMerch('kaos', this)">Kaos</button>
        <button class="merch-filter-btn" onclick="filterMerch('hoodie', this)">Hoodie</button>
        <button class="merch-filter-btn" onclick="filterMerch('poster', this)">Poster</button>
        <button class="merch-filter-btn" onclick="filterMerch('sticker', this)">Sticker</button>
    </div>

    @if($merchandises->count() > 0)
        <div class="merch-grid" id="merchGrid">
            @foreach($merchandises as $merch)
                <div class="merch-card" data-category="{{ $merch->category }}">
                    <div class="merch-img">
                        @if($merch->image)
                            <img src="{{ asset('storage/' . $merch->image) }}" alt="{{ $merch->name }}">
                        @else
                            <i class="bi bi-bag"></i>
                        @endif
                        @if($merch->stock < 5 && $merch->stock > 0)
                            <div class="merch-badge">Last Stock</div>
                        @endif
                    </div>
                    <div class="merch-body">
                        <div class="merch-cat">{{ ucfirst($merch->category) }}</div>
                        <div class="merch-name">{{ $merch->name }}</div>
                        @if($merch->description)
                            <div class="merch-desc">{{ Str::limit($merch->description, 60) }}</div>
                        @endif
                        <div class="merch-footer">
                            <div>
                                <div class="merch-price">Rp {{ number_format($merch->price, 0, ',', '.') }}</div>
                                <div class="merch-stock">Stok: {{ $merch->stock }}</div>
                            </div>
                            <a href="https://wa.me/6281234567890?text=Halo, saya ingin order {{ urlencode($merch->name) }}" target="_blank" class="btn-order">
                                Order
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div style="text-align:center;padding:80px 0;color:var(--gray);">
            <i class="bi bi-bag" style="font-size:64px;display:block;margin-bottom:24px;"></i>
            <p>Belum ada merchandise tersedia.</p>
        </div>
    @endif
</section>

@endsection

@section('scripts')
<script>
    function filterMerch(category, btn) {
        document.querySelectorAll('.merch-filter-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        document.querySelectorAll('.merch-card').forEach(card => {
            if (category === 'all' || card.dataset.category === category) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }
</script>
@endsection