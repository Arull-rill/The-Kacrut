@extends('layouts.frontend')

@section('title', 'Contact — Band Website')

@section('styles')
<style>
    .contact-hero {
        min-height: 50vh;
        display: flex;
        align-items: center;
        padding: 140px 60px 80px;
        background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%);
    }

    .contact-grid {
        display: grid;
        grid-template-columns: 1fr 1.5fr;
        gap: 80px;
        align-items: start;
    }

    /* INFO */
    .contact-info-item {
        display: flex;
        align-items: flex-start;
        gap: 20px;
        margin-bottom: 36px;
    }

    .contact-icon {
        width: 44px;
        height: 44px;
        border: 1px solid rgba(201,168,76,0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--gold);
        font-size: 18px;
        flex-shrink: 0;
    }

    .contact-info-label {
        font-size: 10px;
        letter-spacing: 3px;
        text-transform: uppercase;
        color: var(--gold);
        margin-bottom: 6px;
    }

    .contact-info-value {
        font-size: 14px;
        color: var(--gray-light);
        line-height: 1.6;
    }

    .contact-socials {
        display: flex;
        gap: 12px;
        margin-top: 40px;
    }

    .contact-social-btn {
        width: 44px;
        height: 44px;
        border: 1px solid rgba(255,255,255,0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--gray);
        text-decoration: none;
        font-size: 18px;
        transition: all 0.3s ease;
    }

    .contact-social-btn:hover {
        border-color: var(--gold);
        color: var(--gold);
    }

    /* FORM */
    .contact-form { display: flex; flex-direction: column; gap: 20px; }

    .form-group { display: flex; flex-direction: column; gap: 8px; }

    .form-group label {
        font-size: 11px;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: var(--gray);
    }

    .form-group input,
    .form-group textarea {
        background: var(--dark2);
        border: 1px solid rgba(255,255,255,0.08);
        color: var(--white);
        padding: 14px 18px;
        font-size: 14px;
        font-family: 'Inter', sans-serif;
        transition: border-color 0.3s ease;
        outline: none;
        resize: none;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        border-color: var(--gold);
    }

    .form-group input::placeholder,
    .form-group textarea::placeholder {
        color: rgba(255,255,255,0.2);
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .alert-success {
        background: rgba(201,168,76,0.1);
        border: 1px solid rgba(201,168,76,0.3);
        color: var(--gold);
        padding: 16px 20px;
        font-size: 13px;
        letter-spacing: 1px;
    }

    .alert-error {
        background: rgba(255,59,48,0.1);
        border: 1px solid rgba(255,59,48,0.3);
        color: #ff6b6b;
        padding: 12px 20px;
        font-size: 13px;
    }

    @media (max-width: 768px) {
        .contact-hero { padding: 120px 24px 60px; }
        .contact-grid { grid-template-columns: 1fr; gap: 48px; }
        .form-row { grid-template-columns: 1fr; }
    }
</style>
@endsection

@section('content')

{{-- HERO --}}
<section class="contact-hero">
    <div>
        <div class="section-label">Hubungi Kami</div>
        <h1 class="section-title" style="font-size:clamp(48px,8vw,100px);">Contact</h1>
        <p class="section-desc">Ada pertanyaan, kolaborasi, atau sekadar ingin menyapa? Kami senang mendengar dari kamu.</p>
    </div>
</section>

{{-- CONTACT --}}
<section class="section">
    <div class="contact-grid">

        {{-- INFO --}}
        <div>
            <div class="section-label">Info</div>
            <h2 class="section-title" style="font-size:36px;margin-bottom:40px;">Get In Touch</h2>

            <div class="contact-info-item">
                <div class="contact-icon"><i class="bi bi-envelope"></i></div>
                <div>
                    <div class="contact-info-label">Email</div>
                    <div class="contact-info-value">info@bandwebsite.com</div>
                </div>
            </div>

            <div class="contact-info-item">
                <div class="contact-icon"><i class="bi bi-whatsapp"></i></div>
                <div>
                    <div class="contact-info-label">WhatsApp</div>
                    <div class="contact-info-value">+62 812 3456 7890</div>
                </div>
            </div>

            <div class="contact-info-item">
                <div class="contact-icon"><i class="bi bi-geo-alt"></i></div>
                <div>
                    <div class="contact-info-label">Lokasi</div>
                    <div class="contact-info-value">Bandung, Jawa Barat<br>Indonesia</div>
                </div>
            </div>

            <div class="contact-socials">
                <a href="#" class="contact-social-btn"><i class="bi bi-instagram"></i></a>
                <a href="#" class="contact-social-btn"><i class="bi bi-facebook"></i></a>
                <a href="#" class="contact-social-btn"><i class="bi bi-youtube"></i></a>
                <a href="#" class="contact-social-btn"><i class="bi bi-spotify"></i></a>
            </div>
        </div>

        {{-- FORM --}}
        <div>
            <div class="section-label">Pesan</div>
            <h2 class="section-title" style="font-size:36px;margin-bottom:40px;">Kirim Pesan</h2>

            @if(session('success'))
                <div class="alert-success" style="margin-bottom:24px;">
                    <i class="bi bi-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert-error" style="margin-bottom:24px;">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('contact.store') }}" method="POST" class="contact-form">
                @csrf

                <div class="form-row">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama kamu" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="email@kamu.com" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Subject</label>
                    <input type="text" name="subject" value="{{ old('subject') }}" placeholder="Subject pesan">
                </div>

                <div class="form-group">
                    <label>Pesan</label>
                    <textarea name="message" rows="6" placeholder="Tulis pesanmu di sini..." required>{{ old('message') }}</textarea>
                </div>

                <div>
                    <button type="submit" class="btn-gold">
                        Kirim Pesan <i class="bi bi-send" style="margin-left:8px;"></i>
                    </button>
                </div>
            </form>
        </div>

    </div>
</section>

@endsection