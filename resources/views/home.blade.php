@extends('layouts.app')

@section('title', 'Beranda - jualin')

@section('content')
<div class="container py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h1 class="display-4 fw-bold text-success">♻️ jualin</h1>
            <p class="lead">Temukan barang bekas & salah beli dengan harga terjangkau!</p>
            @guest
            <a href="{{ route('product.create') }}" class="btn btn-success btn-lg mt-3">
                <i class="fas fa-plus-circle me-2"></i> Jual Barang
            </a>
            @endguest
        </div>
    </div>

    <!-- ======= FORM PENCARIAN PRODUK ======= -->
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <form method="GET" action="{{ route('home') }}" class="mb-2">
                <div class="input-group input-group-lg">
                    <input 
                        type="text" 
                        name="search_product" 
                        class="form-control" 
                        placeholder="🔍 Cari barang... (misal: Meja, Hp, Baju)" 
                        value="{{ request('search_product') }}"
                    >
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search me-1"></i> Cari
                    </button>
                </div>
                @if(request('search_product'))
                    <small class="text-muted">
                        Menampilkan hasil untuk: <strong>"{{ request('search_product') }}"</strong>
                        ({{ $products->count() }} produk ditemukan)
                    </small>
                @endif
            </form>
        </div>
    </div>
    <!-- ======= AKHIR FORM PENCARIAN ======= -->

    <!-- Container untuk Cari Admin (sudah ada) -->
    <div class="container mt-3">
        <div class="jumbotron bg-light p-4 rounded-3 text-center">
            <h2 class="display-6">Cari Adminself Terdekat</h2>
            <p class="lead">Temukan admin pengecek barang dan pengirim di lokasi Anda</p>
            <div class="d-flex justify-content-center">
                <a href="{{ route('admin.search') }}" class="btn btn-success btn-lg">
                    <i class="fas fa-search me-2"></i> Cari Admin Sekarang
                </a>
            </div>
        </div>
    </div>

    <!-- Notifikasi Sukses -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Notifikasi Produk Expired -->
    @if(isset($deletedCount) && $deletedCount > 0)
        <div class="alert alert-info mt-3">
            <i class="fas fa-info-circle me-2"></i> {{ $deletedCount }} produk kadaluarsa telah dihapus otomatis!
        </div>
    @endif

    <!-- Banner Carousel (tetap seperti sebelumnya) -->
    <div class="banner-wrapper mt-4">
        <div class="carousel" id="carousel">
            <div class="slides" id="slides">
                <a href="#" class="slide" data-url="https://example.com/promo-40">
                    <div class="slide-content">
                        <h2>Promo 40%</h2>
                        <p>Untuk member baru</p>
                        <span class="btn">Klaim</span>
                    </div>
                    <img src="https://via.placeholder.com/600x300/cccccc/969696?text=Gambar+1" alt="Promo" class="slide-img">
                </a>
                <a href="#" class="slide" data-url="https://example.com/collection-fall">
                    <div class="slide-content">
                        <h2>Koleksi Baru</h2>
                        <p>Musim gugur</p>
                        <span class="btn">Lihat</span>
                    </div>
                    <img src="https://via.placeholder.com/600x300/cccccc/969696?text=Gambar+2" alt="Koleksi" class="slide-img">
                </a>
                <a href="#" class="slide" data-url="https://example.com/flash-sale">
                    <div class="slide-content">
                        <h2>Flash Sale</h2>
                        <p>Extra 20%</p>
                        <span class="btn">Beli</span>
                    </div>
                    <img src="https://via.placeholder.com/600x300/cccccc/969696?text=Gambar+3" alt="Flash Sale" class="slide-img">
                </a>
                <a href="#" class="slide no-image" data-url="https://example.com/newsletter">
                    <div class="slide-content">
                        <h2>Dapatkan Info</h2>
                        <p>Berlangganan newsletter</p>
                        <span class="btn">Daftar</span>
                    </div>
                </a>
            </div>
            <button class="nav-btn prev" id="prevBtn">‹</button>
            <button class="nav-btn next" id="nextBtn">›</button>
            <div class="dots" id="dotsContainer"></div>
        </div>
    </div>
    <script src="/js/banner.js"></script>

    <!-- Filter Kategori Utama -->
    <div class="row mb-3 mt-4">
        <div class="col-12">
            <div class="d-flex flex-wrap gap-2 justify-content-center">
                <a href="{{ route('home') }}" class="btn btn-outline-success {{ request()->routeIs('home') ? 'active' : '' }}">
                    <i class="fas fa-th-large me-1"></i> Semua
                </a>
                <a href="{{ route('category.type', 'bekas') }}" class="btn btn-outline-primary">
                    <i class="fas fa-box me-1"></i> Bekas
                </a>
                <a href="{{ route('category.type', 'salah_beli') }}" class="btn btn-outline-warning">
                    <i class="fas fa-tag me-1"></i> Salah Beli
                </a>
            </div>
        </div>
    </div>

    <!-- Dropdown Filter Kategori Bagian -->
    @if(isset($categories))
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex flex-wrap gap-2 justify-content-center">
                @foreach($categories->groupBy('type') as $type => $items)
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                            {{ ucfirst(str_replace('_', ' ', $type)) }}
                        </button>
                        <ul class="dropdown-menu">
                            @foreach($items as $category)
                                <li>
                                    <a class="dropdown-item" href="{{ route('category.detail', [$type, $category->slug]) }}">
                                        <i class="fas {{ $category->icon }}"></i> {{ $category->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- Daftar Produk -->
    <div class="row">
        @forelse($products ?? [] as $product)
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card h-100 shadow-sm product-card">
                <!-- Gambar -->
                <!-- GAMBAR PRODUK (Path sudah saya samakan dengan halaman detail) -->
@if($product->image)
    <img src="{{ url('images/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
@else
    <div class="card-img-top bg-light text-center py-5" style="height: 200px;">
        <i class="fas fa-box fa-4x text-secondary"></i>
    </div>
@endif

                <div class="card-body">
                    <!-- Badge Kategori -->
                    <span class="badge bg-{{ $product->category->type == 'bekas' ? 'primary' : 'warning' }} mb-2">
                        <i class="fas {{ $product->category->icon }}"></i> {{ $product->category->name }}
                    </span>
                    <span class="badge bg-{{ $product->category->type == 'bekas' ? 'info' : 'danger' }} mb-2">
                        {{ ucfirst(str_replace('_', ' ', $product->category->type)) }}
                    </span>

                    <h5 class="card-title fw-bold">{{ $product->name }}</h5>
                    <p class="card-text text-muted small">{{ Str::limit($product->description, 50) }}</p>
                    <p><span class="badge bg-info">{{ $product->condition }}</span></p>
                    <h5 class="text-success fw-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</h5>

                    <!-- Sisa Hari -->
                    @php
                        $daysLeft = 20 - $product->created_at->diffInDays(now());
                    @endphp
                    <span class="badge bg-{{ $daysLeft <= 3 ? 'danger' : 'warning' }}">
                        <i class="fas fa-clock me-1"></i> {{ $daysLeft }} hari lagi
                    </span>
                </div>

                <div class="card-footer bg-transparent border-0 d-flex flex-column gap-1">
                    <!-- Tombol Detail Produk -->
                    <a href="{{ route('product.detail', $product->id) }}" class="btn btn-success btn-sm w-100">
                        <i class="fas fa-eye me-1"></i> Lihat Detail
                    </a>
                    <!-- Tombol WhatsApp langsung ke penjual -->
                    @if($product->seller_contact)
                        <a href="https://wa.me/{{ $product->seller_contact }}" target="_blank" class="btn btn-outline-success btn-sm w-100">
                            <i class="fab fa-whatsapp me-1"></i> Chat Penjual
                        </a>
                    @else
                        <button class="btn btn-outline-secondary btn-sm w-100" disabled>No WA</button>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <i class="fas fa-box-open fa-4x text-muted mb-3"></i>
            @if(request('search_product'))
                <h4>Tidak ada produk dengan nama "{{ request('search_product') }}"</h4>
                <p class="text-muted">Coba gunakan kata kunci lain.</p>
            @else
                <p class="text-muted">Belum ada produk tersedia</p>
            @endif
            @guest
            <a href="{{ route('product.create') }}" class="btn btn-success">
                <i class="fas fa-plus-circle me-1"></i> Jual Barang Sekarang
            </a>
            @endguest
        </div>
        @endforelse
    </div>
</div>
@endsection