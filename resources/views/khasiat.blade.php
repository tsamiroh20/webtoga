@extends('layouts.dashboard')

@section('contents')
<section id="hero" class="hero d-flex align-items-center" style="min-height: 100vh; margin-bottom: 0px; padding: 80px; position: relative; background: url('{{ asset('assets/img/bg.jpeg') }}') center center/cover no-repeat;">
    <div class="overlay" style="background-color: rgba(157, 200, 148, 0.8); position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1;"></div>
        <div class="container" style="position: relative; z-index: 2;">
            
            <!-- Tombol Kembali -->
            <div class="d-flex justify-content-start mb-4">
                <a href="javascript:void(0);" onclick="history.back()" style="color: #222021; text-decoration: none; font-size: 16px;">
                    <i class="fas fa-arrow-left" style="margin-right: 7px;"></i> Kembali
                </a>
            </div>

            <div class="row gy-4 justify-content-center">
                <!-- Pastikan variabel $tanamans tersedia -->
                @if($tanamans)
                <div class="col-lg-8 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="card h-100" style="height: 100%;">
                        <!-- Carousel memeriksa apakah foto ada untuk tanaman -->
                        @if ($tanamans->fotos && count($tanamans->fotos) > 0)
                        <div id="carousel{{ $tanamans->id }}" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($tanamans->fotos as $index => $foto)
                                <div class="carousel-item @if ($index == 0) active @endif">
                                    <img src="{{ asset('storage/' . $foto->path) }}" class="d-block w-100" alt="Foto Tanaman" style="width: 100%; height: 300px; object-fit: cover;">
                                </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carousel{{ $tanamans->id }}" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carousel{{ $tanamans->id }}" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        @endif
                        <!-- Menampilkan informasi tentang tanaman -->
                        <div class="card-body">
                            <h3 class="card-title" style="font-size: 1.3rem; margin-bottom: 0;">{{ $tanamans->nama_latin }}</h3>
                            <p style="font-style: italic; margin-top: 5px;">{{ $tanamans->nama_ilmiah }}</p>
                            <p><strong>Kandungan Zat:</strong> {{ $tanamans->kandungan_zat }}</p>
                            <p><strong>Perhatian:</strong> {{ $tanamans->perhatian }}</p>
                            <div class="card-text" style="overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                <strong>Khasiat:</strong> {{ $tanamans->khasiat }}
                            </div>
                            <a href="javascript:void(0);" class="read-more" onclick="toggleDescription(this)" style="color: #28a745; text-decoration: none;">Baca selengkapnya</a>
                        </div>
                    </div>
                </div>
                @else
                <div class="alert alert-danger">Tanaman tidak ditemukan.</div>
                @endif
            </div>  
        </div>
    </div>
</section>
<script>
    function toggleDescription(element) {
        var description = element.previousElementSibling;

        if (description.style.webkitLineClamp === "2") {
            description.style.webkitLineClamp = "unset";
            element.innerHTML = "Baca lebih sedikit";
        } else {
            description.style.webkitLineClamp = "2";
            element.innerHTML = "Baca selengkapnya";
        }
    }
</script>
@endsection
