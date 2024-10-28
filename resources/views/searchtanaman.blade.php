@extends('layouts.dashboard')

@section('contents')
<body style="margin: 0; padding: 0; font-family: Poppins, sans-serif; background-color: #f0f0f0;">
    <body style="margin: 0; padding: 0; font-family: Poppins, sans-serif; background-color: #f0f0f0;">
        <section id="hero" class="hero d-flex align-items-center" style="min-height: 100vh; margin-bottom: 0px; position: relative; background: url('{{ asset('assets/img/bg.jpeg') }}') center center/cover no-repeat;">
            <div class="overlay" style="background-color: rgba(157, 200, 148, 0.8); position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1;"></div>
            <div class="container" style="position: relative; z-index: 2;"> 
                <div class="d-flex justify-content-center" style="width: 100%; padding: 80px 0;">
                    <div class="container" data-aos="fade-up" style="max-width: 1200px;">
                       
                    <!-- Tombol Kembali -->
                    <div class="d-flex justify-content-start mb-4">
                        <a href="javascript:void(0);" onclick="history.back()" style="color: #222021; text-decoration: none; font-size: 16px;">
                            <i class="fas fa-arrow-left" style="margin-right: 7px;"></i> Kembali
                        </a>
                    </div>
 
                    <!-- Notifikasi tanaman search-->
                    @if (isset($message))
                    <div class="alert alert-dismissible fade show text-center" role="alert" style="background-color: #ffcccb; color: #721c24;">
                        {{ $message }}
                    </div>
                    @endif

                    <div class="row gy-4 align-items-center features-item" data-aos="fade-up">
                        @foreach ($tanamans as $index => $tanaman)
                        <div class="row gy-4 align-items-center features-item" data-aos="fade-up">
                            <div class="col-md-5 {{ $index % 2 == 0 ? 'order-1 order-md-2' : 'order-1' }}">
                                <!-- Carousel memeriksa apakah foto ada untuk tanaman -->
                                @if ($tanaman->fotos && count($tanaman->fotos) > 0)
                                <div id="carousel{{ $tanaman->id }}" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach ($tanaman->fotos as $indexFoto => $foto)
                                        <div class="carousel-item @if ($indexFoto == 0) active @endif">
                                            <img src="{{ asset('storage/' . $foto->path) }}" class="d-block w-100" alt="Foto Tanaman" style="width: 100%; height: 250px; object-fit: cover;">
                                        </div>
                                        @endforeach
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel{{ $tanaman->id }}" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carousel{{ $tanaman->id }}" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                                @endif
                            </div>
                            <!-- Menampilkan informasi tentang tanaman -->
                            <div class="col-md-7 {{ $index % 2 == 0 ? 'order-2 order-md-1' : 'order-2' }}">
                                <h3>{{ $tanaman->nama_latin }}</h3>
                                <p class="fst-italic" style="margin-top: -10px;">{{ $tanaman->nama_ilmiah }}</p>
                                <div class="card-text" style="overflow: hidden; display: -webkit-box; -webkit-line-clamp: 4; -webkit-box-orient: vertical;">
                                    {{ $tanaman->deskripsi }}
                                </div> 
                                <!-- tautan untuk membaca selengkapnya -->
                                <a href="javascript:void(0);" class="read-more" onclick="toggleDescription(this)" style="color: #f0f0f0; text-decoration: none;">Baca selengkapnya</a>
                                
                                <div class="mt-3">
                                    <a href="{{ route('tanaman.khasiat', $tanaman->id) }}" class="btn btn-success me-2" style="background-color: #f0f0f0; color:#222021"
                                        onmouseover="this.style.backgroundColor='#28a745';" onmouseout="this.style.backgroundColor='#f0f0f0';">Khasiat</a>
                                    <a onclick="showPenyajianAlert()" class="btn btn-success me-2" style="background-color: #f0f0f0; color:#222021"
                                        onmouseover="this.style.backgroundColor='#28a745';" onmouseout="this.style.backgroundColor='#f0f0f0';">Penyajian</a>
                                    <a onclick="showVideoAlert()" class="btn btn-success me-2" style="background-color: #f0f0f0; color:#222021;"
                                        onmouseover="this.style.backgroundColor='#28a745';" onmouseout="this.style.backgroundColor='#f0f0f0';">Video</a>
                                    <script>
                                        function showPenyajianAlert() {
                                            var response = confirm("Untuk melihat data selengkapnya didalam menu cara penyajian silahkan login terlebih dahulu.");
                                            if (response) {
                                                // Redirect ke halaman login jika "Oke" ditekan
                                                window.location.href = '/login';
                                            }
                                            // Tidak melakukan apapun jika "Batal" ditekan
                                        }
                                    </script>
                                    <script>
                                        function showVideoAlert() {
                                            var response = confirm("Untuk melihat data selengkapnya didalam menu video silahkan login terlebih dahulu.");
                                            if (response) {
                                                // Redirect ke halaman login jika "Oke" ditekan
                                                window.location.href = '/login';
                                            }
                                            // Tidak melakukan apapun jika "Batal" ditekan
                                        }
                                    </script>
                                </div>
                            </div>
                        </div>
                        <div class="w-100 my-1"></div> <!-- Menambahkan garis pemisah -->
                        @endforeach
                    </div>
                    @include('includes.paginasi')
                </div>
            </div>
        </div>
    </section>
    <script>
        function toggleDescription(element) {
            var description = element.previousElementSibling;

            if (description.style.webkitLineClamp === "4") {
                description.style.webkitLineClamp = "unset";
                element.innerHTML = "Baca lebih sedikit";
            } else {
                description.style.webkitLineClamp = "4";
                element.innerHTML = "Baca selengkapnya";
            }
        }

        function reloadPage() {
            window.location.href = "/tanaman"; // Atur ini ke URL yang menampilkan semua data tanaman
        }
    </script>
</body>
@endsection
