@extends('layouts.dashboard-user')

@section('contents')
<body style="margin: 0; padding: 0; font-family: Poppins, sans-serif; background-color: #f0f0f0;">
    <section id="hero" class="hero d-flex align-items-center" style="min-height: 100vh; margin-bottom: 0px; position: relative; background: url('{{ asset('assets/img/bg.jpeg') }}') center center/cover no-repeat;">
        <div class="overlay" style="background-color: rgba(157, 200, 148, 0.8); position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1;"></div>
        <div class="container" style="position: relative; z-index: 2;">
            <div class="d-flex justify-content-center" style="width: 100%; padding: 80px 0;">
                <div class="container" data-aos="fade-up" style="max-width: 1200px;">
                    <button type="button" class="btn-close" aria-label="Close" onclick="window.location.href='/homeuser'"></button>
                    
                    <!-- Form Pencarian --> 
                    <div class="d-flex justify-content-center mb-4">
                        <form class="d-flex" action="{{ route('userbudidaya/search') }}" method="GET" style="width: 70%; border-radius: 50px; overflow: hidden; background-color: #fff; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
                            <input class="form-control" type="search" placeholder="Cari nama tanaman..." aria-label="Search" name="query" style="border: none; box-shadow: none; border-radius: 50px 0 0 50px; flex-grow: 1; padding: 10px 20px;">
                            <button class="btn btn-outline-success" type="submit" style="border: none; border-radius: 0 50px 50px 0; background-color: #28a745; color: white; padding: 10px 20px;"
                            onmouseover="this.style.backgroundColor='green';" onmouseout="this.style.backgroundColor='#28a745';">Cari</button>
                        </form>
                    </div>

                    <!-- Notifikasi tanaman search-->
                    @if (isset($message))
                        <div class="alert alert-dismissible fade show" role="alert" style="background-color: #ffcccb; color: #721c24;">
                            {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" onclick="reloadPage()"></button>
                        </div>
                    @endif
                    
                    <div class="row gy-4 justify-content-center">
                        @foreach ($tanamans as $tanaman)
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                            <div class="card h-100" style="height: 100%;">
                                <!-- Carousel memeriksa apakah foto ada untuk tanaman -->
                                @if ($tanaman->fotos && count($tanaman->fotos) > 0)
                                <div id="carousel{{ $tanaman->id }}" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach ($tanaman->fotos as $index => $foto)
                                        <div class="carousel-item @if ($index == 0) active @endif">
                                            <img src="{{ asset('storage/' . $foto->path) }}" class="d-block w-100" alt="Foto Tanaman" style="width: 100%; height: 200px; object-fit: cover;">
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
                                <!-- Menampilkan informasi budidaya -->
                                <div class="card-body">
                                    <h3 class="card-title" style="font-size: 1.3rem; margin-bottom: 0;">{{ $tanaman->nama_latin }}</h3>
                                    <p style="font-style: italic; margin-top: 5px;">{{ $tanaman->nama_ilmiah }}</p>
                                    <div class="card-text" style="overflow: hidden; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;">
                                        {{ $tanaman->cara_budidaya }}
                                    </div>
                                    <!-- tautan untuk membaca selengkapnya -->
                                    <a href="javascript:void(0);" class="read-more" onclick="toggleDescription(this)" style="color: #007bff; text-decoration: none;">Baca selengkapnya</a>
                                </div>
                            </div>
                        </div>
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

            if (description.style.webkitLineClamp === "3") {
                description.style.webkitLineClamp = "unset";
                element.innerHTML = "Baca lebih sedikit";
            } else {
                description.style.webkitLineClamp = "3";
                element.innerHTML = "Baca selengkapnya";
            }
        }

        function reloadPage() {
            window.location.href = "/user/budidaya"; // Atur ini ke URL yang menampilkan semua data tanaman
        }
    </script>
</body>
@endsection