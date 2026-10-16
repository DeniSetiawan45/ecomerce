@extends('layouts.app')

@section('title', 'Dashboard Admin - jualin')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-12">
            <h1 class="display-5 fw-bold text-success">
                <i class="fas fa-tachometer-alt me-2"></i> Dashboard Admin
            </h1>
            <p class="lead">Selamat datang, <strong>{{ Auth::user()->name }}</strong>! 👋</p>
            <hr>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-box me-2"></i> Total Produk</h5>
                    <h1 class="display-4">{{ App\Models\Product::count() }}</h1>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-tags me-2"></i> Total Kategori</h5>
                    <h1 class="display-4">{{ App\Models\Category::count() }}</h1>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-users me-2"></i> Total User</h5>
                    <h1 class="display-4">{{ App\Models\User::count() }}</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-dark text-white">
                    <h5><i class="fas fa-list me-2"></i> Produk Terbaru</h5>
                </div>
                <div class="card-body">
                    @php
                        $products = App\Models\Product::with('category')->latest()->take(5)->get();
                    @endphp
                    @if($products->count())
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Produk</th>
                                        <th>Kategori</th>
                                        <th>Harga</th>
                                        <th>Penjual</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $product)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>
                                            <span class="badge bg-{{ $product->category->type == 'bekas' ? 'primary' : 'warning' }}">
                                                {{ $product->category->name }}
                                            </span>
                                        </td>
                                        <td>Rp {{ number_format($product->price) }}</td>
                                        <td>{{ $product->seller_name }}</td>
                                        <td>{{ $product->created_at->diffForHumans() }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted text-center">Belum ada produk</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 