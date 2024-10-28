@extends('layouts.dashboard-user')

@section('contents')
<section id="hero" class="hero d-flex align-items-center" style="min-height: 100vh; margin-bottom: 0px; position: relative; background: url('{{ asset('assets/img/bg.jpeg') }}') center center/cover no-repeat;">
    <div class="overlay" style="background-color: rgba(157, 200, 148, 0.8); position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1;"></div>
        <div class="container" style="position: relative; z-index: 2;"> 
            <!--membagi area menjadi 2 kolom-->
            <div class="row gy-4 d-flex justify-content-between">
                <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                    <!--kolom teks-->
                    <h2 data-aos="fade-up" style="font-size: 30px; margin-bottom: 20px;">Tanaman Obat Keluarga (Toga)</h2>
                    <p data-aos="fade-up" data-aos-delay="100" style="font-size: 18px; margin-top: 10px; line-height: 1.5;">
                        Tanaman obat keluarga (toga) atau “Apotik Hidup” adalah jenis tanaman obat yang dapat dibudidayakan semua orang karena bisa ditanam disekitar rumah atau kebun 
                        sehingga dapat digunakan untuk kebutuhan obat-obatan ringan keluarga karna dapat dengan mudah untuk diolah sendiri.
                        Penggunaan toga dalam upaya kesehatan digolongkan menjadi 3 manfaat yaitu upaya pencegahan, upaya menjaga / meningkatkan kesehatan dan upaya penyembuhan penyakit.
                    </p> 
                    <form class="d-flex align-items-center" action="{{ route('user/search') }}" method="GET" style="width: 100%; overflow: hidden; background-color: #fff; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); position: relative;">
                        <!--ikon unggah gambar-->
                        <i class="fas fa-camera" style="position: absolute; left: 10px; font-size: 24px; color: #28a745; cursor: pointer;" onclick="document.getElementById('file-input').click();"></i>
                        <input id="file-input" type="file" accept="image/*" style="display: none;" onchange="handleImageSearch(this.files)">
                        <!--input pencarian-->
                        <input class="form-control" type="search" placeholder="Nama tanaman, penyakit atau kandungan..." aria-label="Search" name="query" style="border: none; box-shadow: none; flex-grow: 1; padding: 10px 20px 10px 50px; font-size: 16px; border-radius: 8px 0 0 8px;">
                        <button class="btn btn-outline-success" type="submit" style="border: none; background-color: #28a745; color: white; padding: 10px 20px; transition: background-color 0.3s; font-size: 16px; border-radius: 0 8px 8px 0;"
                        onmouseover="this.style.backgroundColor='green';" onmouseout="this.style.backgroundColor='#28a745';">Cari</button>
                    </form>
                    
                    <!--pesan pencarian gambar-->
                    <script>
                        function handleImageSearch(files) {
                            if (files.length > 0) {
                                alert("Pencarian melalui gambar belum tersedia. Silahkan menggunakan pencarian teks.");
                            }
                        }
                    </script> 
                </div>
                <!--kolom gambar-->
                <div class="col-lg-5 order-1 order-lg-2 olah-img" data-aos="zoom-out">
                    <img src="assets/img/olah.png" class="img-fluid mb-3 mb-lg-0" alt="" style="width: 100%; height: auto;">
                </div>
            </div>
        </div>
    </div>
</section>
@endsection