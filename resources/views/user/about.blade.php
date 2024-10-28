@extends('layouts.dashboard-user')

@section('contents')
<body style="margin: 0; padding: 0; font-family: Poppins, sans-serif; background-color: #f0f0f0;">
    <section id="hero" class="hero d-flex" style="min-height: 100vh; margin-bottom: 0px; position: relative; background: url('{{ asset('assets/img/bg.jpeg') }}') center center/cover no-repeat;">
        <div class="overlay" style="background-color: rgba(157, 200, 148, 0.8); position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1;"></div>
        <div class="container" style="position: relative; z-index: 2;">
            <div class="d-flex justify-content-center" style="width: 100%; padding: 80px 0;">
                <div class="container" data-aos="fade-up" style="max-width: 1200px;">
                    <button type="button" class="btn-close" aria-label="Close" onclick="window.location.href='/homeuser'"></button>
                    <h1 style="text-align: center; font-size: 1.7rem; font-weight: bold;">Selamat datang di Aplikasi Tanaman TOGA (Tanaman Obat Keluarga)!</h1>
                    <hr/>

                    <h5 class="mt-4">Tujuan</h5>
                    <p>Aplikasi web ini dibuat untuk mempermudah masyarakat dalam mengenal dan memanfaatkan tanaman obat yang sering ditemukan di sekitar rumah. 
                        Dengan aplikasi ini, diharapkan akan menjadi sarana edukasi, informasi dan promosi tanaman toga kepada masyarakat sehingga dapat meningkatkan kesadaran akan pentingnya tanaman obat dan manfaatnya dalam kehidupan sehari-hari.</p>

                    <h5 class="mt-4">Menu</h5>
                    <ul>
                        <li><strong>Tanaman Toga :</strong> Informasi lengkap tentang tanaman toga, termasuk nama ilmiah, deskripsi, khasiat, kandungan, dosis, perhatian penggunaan, cara penyajian, dan gambar.</li>
                        <li><strong>Budidaya :</strong> Petunjuk dan informasi penanaman toga serta cara pengembangbiakannya</li>
                        <li><strong>FAQ :</strong> Pertanyaan dan jawaban umum terkait toga.</li>
                        <li><strong>Tanggapan :</strong> Halaman untuk mengirimkan tanggapan berupa kritik dan saran terkait aplikasi web toga</li>
                        <li><strong>Tentang :</strong> Informasi terkait tujuan, penjelasan menu aplikasi, visi dan misi, kontak, tim pengembang dan referensi data yang digunakan</li>
                    </ul>

                    <h5 class="mt-4">Visi dan Misi</h5>
                    <ul>
                        <li><strong>Visi :</strong> Menjadi sarana edukasi, informasi dan promosi tanaman toga kepada masyarakat Indonesia.</li>
                        <li><strong>Misi :</strong> Meningkatkan kesadaran dan pengetahuan masyarakat tentang tanaman obat keluarga, serta mendorong penggunaan tanaman obat sebagai alternatif pengobatan yang alami dan aman.</li>
                    </ul>

                    <h5 class="mt-4">Kontak Kami</h5>
                    <p>Jika Anda memiliki pertanyaan dapat menghubungi kami di <a href="mailto : mtsamiroh@gmail.com">mtsamiroh@gmail.com</a>.</p>
                
                </div>
            </div>
        </div>
    </section>
</body>
@endsection