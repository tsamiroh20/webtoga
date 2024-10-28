<nav class="navbar navbar-expand-lg fixed-top" style="background-color: #28a745">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-4 mt-2">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('homeadmin') ? 'active' : '' }}" style="font-weight: 500; cursor: pointer;" href="{{ route('homeadmin') }}"><i class="fa-solid fa-house"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin/tanaman') ? 'active' : '' }}" style="font-weight: 500; cursor: pointer;" href="{{ route('admin/tanaman') }}">Data Tanaman Toga</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin/penyajian') ? 'active' : '' }}" style="font-weight: 500; cursor: pointer;" href="{{ route('admin/penyajian') }}">Cara Penyajian</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin/vidio') ? 'active' : '' }}" style="font-weight: 500; cursor: pointer;" href="{{ route('admin/vidio') }}">Video</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin/referensi') ? 'active' : '' }}" style="font-weight: 500; cursor: pointer;" href="{{ route('admin/referensi') }}">Referensi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin/faq') ? 'active' : '' }}" style="font-weight: 500; cursor: pointer;" href="{{ route('admin/faq') }}">FAQ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin/tanggapan') ? 'active' : '' }}" style="font-weight: 500; cursor: pointer;" href="{{ route('admin/tanggapan') }}">Tanggapan</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        @if (Auth::user()->profile && Auth::user()->profile->foto_profile)
                            <img class="rounded-circle"
                                src="{{ asset('storage/' . Auth::user()->profile->foto_profile) }}"
                                alt="Gambar profil" width="30" height="30">
                        @else
                            <img class="rounded-circle"
                                src="{{ asset('images/default-profile.png') }}"
                                alt="Gambar profil default" width="30" height="30">
                        @endif
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="{{ url('/admin/profile', ['id' => Auth::user()->id]) }}">Profil</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ url('/logout') }}">Keluar</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="bi bi-bell"></i></a>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Masuk</a>
                </li>
                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Daftar</a>
                </li>
                @endif
                @endauth
            </ul>
        </div>
    </div>
</nav>
@include('includes.navstyle')