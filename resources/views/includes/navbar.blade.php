<nav class="navbar navbar-expand-lg fixed-top" style="background-color: #28a745;">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-4 mt-2">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" style="font-weight: 500; cursor: pointer;" href="{{ route('home') }}"><i class="fa-solid fa-house"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('tanaman') ? 'active' : '' }}" style="font-weight: 500; cursor: pointer;" href="{{ route('tanaman') }}">Tanaman Toga</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}" style="font-weight: 500; cursor: pointer;" onclick="showBudidayaAlert()">Budidaya</a>
                </li>
                <script>
                    function showBudidayaAlert() {
                        var response = confirm("Untuk melihat isi data selengkapnya di dalam menu Budidaya, silahkan login terlebih dahulu.");
                        if (response) {
                            // Redirect ke halaman login jika "Oke" ditekan
                            window.location.href = '/login';
                        }
                        // Tidak melakukan apapun jika "Batal" ditekan
                    }
                </script>
                
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('faq') ? 'active' : '' }}" style="font-weight: 500; cursor: pointer;" href="{{ route('faq') }}">FAQ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}" style="font-weight: 500; cursor: pointer;" onclick="showTanggapanAlert()">Tanggapan</a>
                </li>
                <script>
                    function showTanggapanAlert() {
                        var response = confirm("Untuk melihat isi data selengkapnya didalam menu Tanggapan silahkan login terlebih dahulu.");
                        if (response) {
                            // Redirect ke halaman login jika "Oke" ditekan
                            window.location.href = '/login';
                        }
                        // Tidak melakukan apapun jika "Batal" ditekan
                    }
                </script>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('referensi') ? 'active' : '' }}" style="font-weight: 500; cursor: pointer;" href="{{ route('referensi') }}">Referensi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" style="font-weight: 500; cursor: pointer;" href="{{ route('about') }}">Tentang</a>
                </li>
            </ul>
            <div class="d-flex justify-content-end mt-2">
                <div class="btn-group" role="group" aria-label="Login and Register">
                    <a href="{{ route('login') }}" class="btn btn-outline-success" style="color: #222021; font-weight: 500; cursor: pointer; border-color: #222021;" 
                        onmouseover="this.style.backgroundColor='green'; this.style.color='white'" 
                        onmouseout="this.style.backgroundColor='transparent'; this.style.color='#222021'">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-success" style="color: #222021; font-weight: 500; cursor: pointer; border-color: #222021;"
                        onmouseover="this.style.backgroundColor='green'; this.style.color='white'" 
                        onmouseout="this.style.backgroundColor='transparent'; this.style.color='#222021'">Register</a>
                </div>
            </div>
        </div>
    </div>
</nav>
@include('includes.navstyle')

