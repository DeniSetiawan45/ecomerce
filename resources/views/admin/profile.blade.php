@extends('layouts.app')

@section('title', 'Profil Admin - jualin')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-12">
            <h1 class="display-5 fw-bold text-primary">
                <i class="fas fa-user-circle me-2"></i> Profil Admin
            </h1>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5><i class="fas fa-id-card me-2"></i> Data Diri</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th width="30%">Nama</th>
                            <td>: <strong>{{ $admin->name }}</strong></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>: {{ $admin->email }}</td>
                        </tr>
                        <tr>
                            <th>Lokasi</th>
                            <td>: {{ $admin->location ?? 'Belum diisi' }}</td>
                        </tr>
                        <tr>
                            <th>No. WhatsApp</th>
                            <td>: {{ $admin->wa_number ?? 'Belum diisi' }}</td>
                        </tr>
                        <tr>
                            <th>Rating</th>
                            <td>
                                : 
                                <span class="badge bg-warning text-dark">
                                    ⭐ {{ number_format($admin->rating ?? 0, 1) }} / 5
                                </span>
                                <small>(dari {{ $admin->total_ratings ?? 0 }} penilaian)</small>
                            </td>
                        </tr>
                        <tr>
                            <th>Bergabung</th>
                            <td>: {{ $admin->created_at->format('d M Y') }}</td>
                        </tr>
                    </table>

                    <div class="mt-3">
                        @auth
                            @if (Auth::user()->isAdmin())
                                <a href="{{ url('/admin/profile/edit') }}" class="btn btn-warning">
                                    <i class="fas fa-edit me-1"></i> Edit Profil
                                </a>
                            @endif
                        @endauth
                        <a href="{{ url('/admin/dashboard') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Kembali ke Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h5><i class="fas fa-star me-2"></i> Ulasan & Rating</h5>
                </div>
                <div class="card-body text-center py-5">
                    <i class="fas fa-star fa-3x text-warning mb-3"></i>
                    <h3>{{ number_format($admin->rating ?? 0, 1) }} / 5.0</h3>
                    <p class="text-muted">Dari {{ $admin->total_ratings ?? 0 }} pembeli</p>
                    <div class="progress" style="height: 30px;">
                        <div class="progress-bar bg-warning text-dark fw-bold" 
                             style="width: {{ ($admin->rating ?? 0) / 5 * 100 }}%;">
                            {{ number_format(($admin->rating ?? 0) / 5 * 100, 0) }}%
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection