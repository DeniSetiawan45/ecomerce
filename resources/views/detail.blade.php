@extends('layouts.app')

@section('title', $product->name . ' - jualin')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-6">
            @if($product->image)
                <img src="{{ asset('images/' . $product->image) }}" class="img-fluid rounded shadow" alt="{{ $product->name }}">
            @else
                <div class="bg-light text-center py-5 rounded shadow" style="height: 400px;">
                    <i class="fas fa-box fa-5x text-secondary"></i>
                    <p class="text-muted mt-3">Tidak ada gambar</p>
                </div>
            @endif
        </div>

        <div class="col-md-6">
            <div class="mb-2">
                <span class="badge bg-{{ $product->category->type == 'bekas' ? 'primary' : 'warning' }} fs-6">
                    <i class="fas {{ $product->category->icon }}"></i> {{ $product->category->name }}
                </span>
                <span class="badge bg-{{ $product->category->type == 'bekas' ? 'info' : 'danger' }} fs-6">
                    {{ ucfirst(str_replace('_', ' ', $product->category->type)) }}
                </span>
            </div>

            <h1 class="display-6">{{ $product->name }}</h1>
            <h2 class="text-success fw-bold mt-3">Rp {{ number_format($product->price, 0, ',', '.') }}</h2>

            <div class="mt-3">
                <span class="badge bg-info fs-6">{{ $product->condition }}</span>
            </div>

            <hr>
            <h5><i class="fas fa-align-left me-2"></i> Deskripsi</h5>
            <p class="text-secondary">{{ $product->description }}</p>
            <hr>

            <div class="row">
                <div class="col-6">
                    <p><strong><i class="fas fa-user me-2"></i> Penjual</strong></p>
                    <p>{{ $product->seller_name }}</p>
                </div>
                <div class="col-6">
                    <p><strong><i class="fas fa-phone me-2"></i> Kontak</strong></p>
                    <p>{{ $product->seller_contact }}</p>
                </div>
            </div>

            @php
    $daysLeft = 20 - (int) $product->created_at->diffInDays(now());
    if ($daysLeft < 0) $daysLeft = 0;
@endphp

Produk aktif selama <strong>{{ $daysLeft }}</strong> hari lagi
            <div class="alert alert-{{ $daysLeft <= 3 ? 'danger' : 'warning' }}">
                <i class="fas fa-clock me-2"></i>
                @if($daysLeft <= 0)
                    <span class="text-danger fw-bold">⚠️ Produk sudah kadaluarsa!</span>
                @elseif($daysLeft <= 3)
                    <span class="text-danger fw-bold">⚠️ Produk akan dihapus dalam {{ $daysLeft }} hari!</span>
                @else
                    <span>Produk aktif selama <strong>{{ $daysLeft }}</strong> hari lagi</span>
                @endif
            </div>

            <div class="d-grid gap-2">
                <a href="https://wa.me/{{ $product->seller_contact }}" target="_blank" class="btn btn-success">
                    <i class="fab fa-whatsapp me-2"></i> Hubungi Penjual via WhatsApp
                </a>
                <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>
@endsection