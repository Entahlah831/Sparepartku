<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">Sparepartku</a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}" href="{{ route('products.index') }}">Katalog</a>
                </li>
            </ul>
            
            <ul class="navbar-nav ms-auto align-items-center">
                @auth
                @if(Auth::user()->email == 'admin@toko.com')
                    <li class="nav-item me-2">
                        <a class="btn btn-outline-light fw-bold" href="{{ route('admin.products.create') }}">
                            ➕ Tambah Barang
                        </a>
                    </li>
                @endif
                    <li class="nav-item me-3">
                        <a class="nav-link position-relative" href="{{ route('carts.index') }}">
                            <i class="fas fa-shopping-cart"></i> Keranjang
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                                {{ \App\Models\Cart::where('user_id', Auth::id())->count() }}
                            </span>
                        </a>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown">
                            Halo, {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('users.index') }}">👤 Profil Saya</a></li>
                            <li><a class="dropdown-item" href="{{ route('transactions.index') }}">📜 Riwayat Belanja</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">Logout 🚪</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Masuk</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-warning btn-sm fw-bold ms-2" href="{{ route('register') }}">Daftar</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>