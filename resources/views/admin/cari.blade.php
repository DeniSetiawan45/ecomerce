@extends('layouts.app')

@section('title', 'Cari Adminself - jualin')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-12">
            <h1 class="display-5 fw-bold text-primary">
                <i class="fas fa-search me-2"></i> Cari Adminself
            </h1>
            <p class="lead">Temukan admin pengecek barang terdekat dari lokasi Anda</p>
            <hr>
        </div>
    </div>

    <!-- Form Pencarian -->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="GET" action="{{ route('admin.search') }}" class="mb-5">
                <div class="input-group input-group-lg">
                    <input 
                        type="text" 
                        name="location" 
                        class="form-control" 
                        placeholder="Masukkan lokasi, misal: Jakarta, Bandung, Surabaya..." 
                        value="{{ request('location') }}"
                    >
                    <button class="btn btn-success" type="submit">
                        <i class="fas fa-search me-1"></i> Cari
                    </button>
                </div>
                @if(request('location'))
                    <small class="text-muted">Menampilkan hasil untuk: <strong>"{{ request('location') }}"</strong></small>
                @endif
            </form>
        </div>
    </div>

    <!-- Hasil Pencarian -->
    <div class="row">
        @forelse($admins as $admin)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <h5 class="card-title text-primary">
                                <i class="fas fa-user-circle me-1"></i> {{ $admin->name }}
                            </h5>
                            <span class="badge bg-warning text-dark">
                                ⭐ {{ number_format($admin->rating ?? 0, 1) }}
                            </span>
                        </div>
                        
                        <p class="card-text mt-2">
                            <i class="fas fa-map-marker-alt text-danger me-2"></i> 
                            {{ $admin->location ?? 'Lokasi belum diisi' }}
                        </p>
                        
                        <p class="card-text">
                            <i class="fab fa-whatsapp text-success me-2"></i> 
                            {{ $admin->wa_number ?? 'Nomor WA belum diisi' }}
                        </p>

                        <p class="card-text">
                            <small class="text-muted">
                                <i class="fas fa-star me-1"></i> 
                                {{ $admin->total_ratings ?? 0 }} penilaian
                            </small>
                        </p>
                    </div>
                    <div class="card-footer bg-white border-top-0">
                        @if($admin->wa_number)
                            <a href="https://wa.me/{{ $admin->wa_number }}" target="_blank" class="btn btn-success w-100">
                                <i class="fab fa-whatsapp me-2"></i> Hubungi via WhatsApp
                            </a>
                        @else
                            <button class="btn btn-secondary w-100" disabled>Nomor WA tidak tersedia</button>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center py-5">
                    <i class="fas fa-info-circle fa-3x mb-3 d-block"></i>
                    <h4>Belum ada admin ditemukan</h4>
                    <p class="mb-0">
                        @if(request('location'))
                            Tidak ada admin dengan lokasi "{{ request('location') }}". 
                            Coba gunakan kata kunci lain.
                        @else
                            Silakan masukkan lokasi untuk mencari admin terdekat.
                        @endif
                    </p>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Tombol Kembali -->
    <div class="row mt-3">
        <div class="col-12">
            <a href="{{ url('/') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda
            </a>
        </div>
    </div>
</div>
@endsection