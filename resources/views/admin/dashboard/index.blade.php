@extends('admin.layouts.admin')

@section('title', 'Dashboard')

@section('content')

<div class="page-header">
    <div class="page-header-left">
        <div class="page-label">Overview</div>
        <h1>Dashboard</h1>
    </div>
    <a href="{{ route('home') }}" target="_blank" class="btn btn-secondary">
        <i class="bi bi-box-arrow-up-right"></i> Lihat Website
    </a>
</div>

{{-- STAT CARDS --}}
<div class="stats-grid">
    <div class="stat-card">
        <div>
            <div class="stat-value">{{ $stats['musics'] }}</div>
            <div class="stat-label">Total Lagu</div>
        </div>
        <div class="stat-icon" style="color:var(--gold);">
            <i class="bi bi-music-note-beamed"></i>
        </div>
    </div>

    <div class="stat-card">
        <div>
            <div class="stat-value">{{ $stats['albums'] }}</div>
            <div class="stat-label">Total Album</div>
        </div>
        <div class="stat-icon" style="color:var(--info);">
            <i class="bi bi-vinyl"></i>
        </div>
    </div>

    <div class="stat-card">
        <div>
            <div class="stat-value">{{ $stats['galleries'] }}</div>
            <div class="stat-label">Total Foto/Video</div>
        </div>
        <div class="stat-icon" style="color:var(--success);">
            <i class="bi bi-images"></i>
        </div>
    </div>

    <div class="stat-card">
        <div>
            <div class="stat-value">{{ $stats['merchandises'] }}</div>
            <div class="stat-label">Total Merchandise</div>
        </div>
        <div class="stat-icon" style="color:var(--warning);">
            <i class="bi bi-bag"></i>
        </div>
    </div>

    <div class="stat-card">
        <div>
            <div class="stat-value">{{ $stats['orders'] }}</div>
            <div class="stat-label">Total Order</div>
        </div>
        <div class="stat-icon" style="color:var(--info);">
            <i class="bi bi-box-seam"></i>
        </div>
    </div>

    <div class="stat-card">
        <div>
            <div class="stat-value" style="color:var(--danger);">{{ $stats['messages'] }}</div>
            <div class="stat-label">Pesan Belum Dibaca</div>
        </div>
        <div class="stat-icon" style="color:var(--danger);">
            <i class="bi bi-envelope"></i>
        </div>
    </div>

    <div class="stat-card">
        <div>
            <div class="stat-value">{{ $stats['users'] }}</div>
            <div class="stat-label">Total User</div>
        </div>
        <div class="stat-icon" style="color:var(--success);">
            <i class="bi bi-people"></i>
        </div>
    </div>

    <div class="stat-card" style="cursor:pointer;" onclick="window.location='{{ route('admin.settings.index') }}'">
        <div>
            <div class="stat-value" style="font-size:28px;padding-top:8px;">Settings</div>
            <div class="stat-label">Kelola Website</div>
        </div>
        <div class="stat-icon" style="color:var(--gray);">
            <i class="bi bi-gear"></i>
        </div>
    </div>
</div>

{{-- BOTTOM GRID --}}
<div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">

    {{-- RECENT MESSAGES --}}
    <div class="card">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
            <div class="card-title" style="margin-bottom:0;">Pesan Terbaru</div>
            <a href="{{ route('admin.contact.index') }}" class="btn btn-secondary btn-sm">Lihat Semua</a>
        </div>

        @if($recentMessages->count() > 0)
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Subject</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentMessages as $msg)
                        <tr>
                            <td>
                                <div style="font-size:13px;font-weight:500;">{{ $msg->name }}</div>
                                <div style="font-size:11px;color:var(--gray);">{{ $msg->email }}</div>
                            </td>
                            <td style="color:var(--gray);font-size:12px;">
                                {{ Str::limit($msg->subject ?? 'No subject', 20) }}
                            </td>
                            <td>
                                @if($msg->is_read)
                                    <span class="badge badge-gray">Dibaca</span>
                                @else
                                    <span class="badge badge-danger">Baru</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.contact.show', $msg) }}" class="btn btn-secondary btn-sm">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div style="text-align:center;padding:32px;color:var(--gray);">
                <i class="bi bi-inbox" style="font-size:32px;display:block;margin-bottom:8px;"></i>
                Belum ada pesan masuk
            </div>
        @endif
    </div>

    {{-- RECENT ORDERS --}}
    <div class="card">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
            <div class="card-title" style="margin-bottom:0;">Order Terbaru</div>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary btn-sm">Lihat Semua</a>
        </div>

        @if($recentOrders->count() > 0)
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Pemesan</th>
                        <th>Produk</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentOrders as $order)
                        <tr>
                            <td>
                                <div style="font-size:13px;font-weight:500;">{{ $order->name }}</div>
                                <div style="font-size:11px;color:var(--gold);">
                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                </div>
                            </td>
                            <td style="font-size:12px;color:var(--gray);">
                                {{ Str::limit($order->merchandise->name ?? '—', 20) }}
                            </td>
                            <td>
                                @php
                                    $statusClass = match($order->status) {
                                        'pending'   => 'badge-warning',
                                        'paid'      => 'badge-info',
                                        'shipped'   => 'badge-gold',
                                        'completed' => 'badge-success',
                                        'cancelled' => 'badge-danger',
                                        default     => 'badge-gray',
                                    };
                                @endphp
                                <span class="badge {{ $statusClass }}">{{ ucfirst($order->status) }}</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div style="text-align:center;padding:32px;color:var(--gray);">
                <i class="bi bi-box-seam" style="font-size:32px;display:block;margin-bottom:8px;"></i>
                Belum ada order masuk
            </div>
        @endif
    </div>

</div>

{{-- QUICK ACTION --}}
<div style="margin-top:20px;">
    <div class="card">
        <div class="card-title">Quick Action</div>
        <div style="display:flex;gap:12px;flex-wrap:wrap;">
            <a href="{{ route('admin.music.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Tambah Lagu
            </a>
            <a href="{{ route('admin.albums.create') }}" class="btn btn-secondary">
                <i class="bi bi-plus-lg"></i> Tambah Album
            </a>
            <a href="{{ route('admin.gallery.create') }}" class="btn btn-secondary">
                <i class="bi bi-plus-lg"></i> Tambah Foto
            </a>
            <a href="{{ route('admin.merchandise.create') }}" class="btn btn-secondary">
                <i class="bi bi-plus-lg"></i> Tambah Merchandise
            </a>
            <a href="{{ route('admin.users.create') }}" class="btn btn-secondary">
                <i class="bi bi-person-plus"></i> Tambah User
            </a>
        </div>
    </div>
</div>

@endsection