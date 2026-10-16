@extends('layouts.app')

@section('title', 'Jual Barang - jualin')

@section('content')
<!-- Kontainer utama halaman jual barang -->
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <!-- Judul halaman -->
                <div class="card-header bg-success text-white">
                    <h4><i class="fas fa-plus-circle me-2"></i> Jual Barang</h4>
                </div>

                <div class="card-body">
                    <!-- Tampilkan semua pesan validasi dari server -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Form data barang -->
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Pilihan kategori disimpan melalui input tersembunyi -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Kategori *</label>
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary dropdown-toggle w-100 text-start" type="button" data-bs-toggle="dropdown" id="categoryDropdown">
                                    Pilih Kategori
                                </button>
                                <ul class="dropdown-menu w-100" aria-labelledby="categoryDropdown">
                                    @foreach ($categories as $category)
                                        <li>
                                            <a class="dropdown-item" href="#" onclick="document.getElementById('category_id_hidden').value = '{{ $category->id }}'; document.getElementById('categoryDropdown').innerText = '{{ $category->name }}';">
                                                {{ $category->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <input type="hidden" name="category_id" id="category_id_hidden" value="">
                        </div>

                        <!-- Informasi dasar barang -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Barang *</label>
                            <input type="text" name="name" class="form-control" placeholder="Contoh: Meja Kayu Jati" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Harga (Rp) *</label>
                            <input type="number" name="price" class="form-control" placeholder="350000" required min="1000">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Kondisi *</label>
                            <select name="condition" class="form-select" required>
                                <option value="">Pilih Kondisi</option>
                                <option value="Baru - Segel">Baru - Segel</option>
                                <option value="Bekas - 90%">Bekas - 90%</option>
                                <option value="Bekas - 80%">Bekas - 80%</option>
                                <option value="Bekas - 70%">Bekas - 70%</option>
                                <option value="Bekas - 60%">Bekas - 60%</option>
                                <option value="Bekas - 50%">Bekas - 50%</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Deskripsi *</label>
                            <textarea name="description" class="form-control" rows="4" placeholder="Deskripsikan barang kamu..." required></textarea>
                        </div>

                        <!-- Upload foto barang -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Foto Barang</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                            <small class="text-muted">Format: JPG, PNG | Max: 2MB</small>
                        </div>

                        <!-- Informasi kontak penjual -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Nama Penjual *</label>
                                    <input type="text" name="seller_name" class="form-control" placeholder="Nama kamu" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Kontak (WA/HP) *</label>
                                    <input type="text" name="seller_contact" class="form-control" placeholder="08123456789" required>
                                </div>
                            </div>
                        </div>

                        <!-- Informasi masa aktif produk -->
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Produk akan otomatis dihapus setelah <strong>20 hari</strong>!
                        </div>

                        <button type="submit" class="btn btn-success w-100">
                            <i class="fas fa-paper-plane me-2"></i> Jual Sekarang
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection