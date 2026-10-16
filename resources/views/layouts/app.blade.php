<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'jualin - Jual Beli Barang Bekas')</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Hubungkan CSS -->
    <link rel="stylesheet" href="/css/banner.css">
    <a class="nav-link" href="{{ route('admin.search') }}">
    <i class="fas fa-search"></i> Cari Admin </a>
</head>
<body>
    
    <!-- ========================================== -->
    <!-- NAVBAR / HEADER -->
    <!-- ========================================== -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
        <div class="container">
            <!-- Brand / Logo -->
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">
                <i class="fas fa-store me-2"></i>jualin
            </a>
            
            <!-- Toggle Button (Mobile) -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Navbar Menu -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <!-- Beranda -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            <i class="fas fa-home me-1"></i> Beranda
                        </a>
                    </li>

                    
                    
                    <!-- GUEST: Bisa lihat tombol Jual Barang -->
                    @guest
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('product.create') ? 'active' : '' }}" href="{{ route('product.create') }}">
                            <i class="fas fa-plus-circle me-1"></i> Jual Barang
                        </a>
                    </li>
                    @endguest

                    <!-- ADMIN: Lihat Dashboard -->
                    @auth
                        @if(Auth::user()->isAdmin())
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-tachometer-alt me-1"></i> Dashboard
                            </a>
                        </li>
                        @endif
                    @endauth
                </ul>

                
                <!-- Right Side -->
                <div class="d-flex align-items-center gap-2">
                    @auth
                        <!-- User Info -->
                        <span class="navbar-text text-white me-2">
                            <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                            @if(Auth::user()->isAdmin())
                                <span class="badge bg-success ms-1">Admin</span>
                            @endif
                        </span>
                        
                        <!-- Logout -->
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-light btn-sm">
                                <i class="fas fa-sign-out-alt me-1"></i> Logout
                            </button>
                        </form>
                    @else
                        <!-- 🔥 GANTI TOMBOL LOGIN/REGISTER DENGAN WHATSAPP -->
                        <a href="https://wa.me/6283137290054" target="_blank" class="btn btn-success btn-sm">
                            <i class="fab fa-whatsapp me-1"></i> Hubungi Kami
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
    
    <!-- ========================================== -->
    <!-- MAIN CONTENT -->
    <!-- ========================================== -->
    <main>
        @yield('content')
    </main>

    
    
    <!-- ========================================== -->
    <!-- FOOTER -->
    <!-- ========================================== -->
    <footer class="bg-dark text-white mt-5 py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5><i class="fas fa-store me-2"></i>jualin</h5>
                    <p class="text-white-50">Platform jual beli barang bekas & salah beli terpercaya.</p>
                </div>
                <div class="col-md-4">
                    <h5>Menu</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Beranda</a></li>
                        @guest
                        <li><a href="{{ route('product.create') }}" class="text-white-50 text-decoration-none">Jual Barang</a></li>
                        @endguest
                        @auth
                            @if(Auth::user()->isAdmin())
                            <li><a href="{{ route('admin.dashboard') }}" class="text-white-50 text-decoration-none">Dashboard</a></li>
                            @endif
                        @endauth
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Kontak</h5>
                    <p class="text-white-50">
                        <i class="fab fa-whatsapp me-2"></i>
                        <a href="https://wa.me/6283137290054" target="_blank" class="text-white-50 text-decoration-none">
                            0831 3729 0054
                        </a>
                    </p>
                    <p class="text-white-50">
                        <i class="fas fa-envelope me-2"></i>daghardeniapk@gmail.com
                    </p>
                </div>
            </div>
            <hr class="border-secondary">
            <p class="text-center text-white-50 mb-0">&copy; {{ date('Y') }} jualin. All rights reserved.</p>
        </div>
    </footer>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <!-- <script src="{{ asset('js/script.js') }}"></script> -->
</body>
</html>