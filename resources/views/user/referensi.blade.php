@extends('layouts.dashboard-user')

@section('contents')
<body style="margin: 0; padding: 0; font-family: Poppins, sans-serif; background-color: #f0f0f0;">
    <section id="hero" class="hero d-flex align-items-center" style="min-height: 100vh; margin-bottom: 0px; position: relative; background: url('{{ asset('assets/img/bg.jpeg') }}') center center/cover no-repeat;">
        <div class="overlay" style="background-color: rgba(157, 200, 148, 0.8); position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1;"></div>
        <div class="container" style="position: relative; z-index: 2;">
            <div class="d-flex justify-content-center" style="width: 100%; padding: 80px 0;">
                <div class="container" data-aos="fade-up" style="max-width: 1200px;">
                    <button type="button" class="btn-close" aria-label="Close" onclick="window.location.href='/homeuser'"></button>
                    <h1 style="text-align: center; font-size: 1.7rem; font-weight: bold;">Halaman Referensi Data</h1>
                    <hr/>

                    <!-- Form Pencarian --> 
                    <div class="d-flex justify-content-center mb-4">
                        <form class="d-flex" action="{{ route('userreferensi/search') }}" method="GET" style="width: 70%; border-radius: 50px; overflow: hidden; background-color: #fff; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
                            <input class="form-control" type="search" placeholder="Cari nama tanaman..." aria-label="Search" name="query" style="border: none; box-shadow: none; border-radius: 50px 0 0 50px; flex-grow: 1; padding: 10px 20px;">
                            <button class="btn btn-outline-success" type="submit" style="border: none; border-radius: 0 50px 50px 0; background-color: #28a745; color: white; padding: 10px 20px;"
                            onmouseover="this.style.backgroundColor='green';" onmouseout="this.style.backgroundColor='#28a745';">Cari</button>
                        </form>
                    </div>

                    <p style="text-align: center;" ><strong>Foto tanaman yang digunakan dalam aplikasi web ini diambil dari foto google</strong></p>
                    <p style="text-align: center;" >Berikut adalah acuan referensi data yang digunakan didalam web tanaman obat keluarga (TOGA)</p>
                    
                    <!-- Notifikasi tanaman search-->
                    @if (isset($message))
                        <div class="alert alert-dismissible fade show" role="alert" style="background-color: #ffcccb; color: #721c24;">
                            {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" onclick="reloadPage()"></button>
                        </div>
                    @endif
                    
                    <ul>
                        @php
                            $displayedLatinNames = []; // Array untuk menyimpan nama Latin yang sudah ditampilkan
                        @endphp
                    
                        @foreach($referensis as $referensi)
                            @php
                                $tanaman = $referensi->tanaman; // Mengambil model tanaman terkait
                    
                                // Pastikan tanaman valid
                                if (!$tanaman) {
                                    continue; // Jika tidak ada tanaman, lanjut ke iterasi berikutnya
                                }
                    
                                $tanamanId = $tanaman->id; // Mendapatkan ID tanaman
                                $latinName = $tanaman->nama_latin ?? 'Tidak diketahui'; // Mendapatkan nama Latin
                            @endphp
                    
                            <!-- Cek apakah nama Latin sudah ditampilkan -->
                            @if(!in_array($tanamanId, $displayedLatinNames))
                                <!-- Tambahkan nama Latin ke dalam array displayedLatinNames -->
                                @php
                                    $displayedLatinNames[] = $tanamanId;
                                @endphp
                    
                                <!-- Tampilkan nama Latin -->
                                <li style="margin-top: 25px;">
                                    <strong>{{ $latinName }}</strong>
                                </li>
                    
                                <!-- Tampilkan referensi dan pustaka yang sesuai dengan tanaman ID -->
                                <ul>
                                    @foreach($referensis->where('tanaman_id', $tanamanId) as $referensiTanaman)
                                        @foreach(explode("\n", $referensiTanaman->referensi) as $index => $referensiItem)
                                            @php
                                                // Ambil link dari kolom pustaka berdasarkan indeks yang sama
                                                $pustakaItems = explode("\n", $referensiTanaman->pustaka);
                                                $pustakaLink = trim($pustakaItems[$index] ?? '#');
                    
                                                // Tambahkan skema jika hilang
                                                if (!preg_match("~^(?:f|ht)tps?://~i", $pustakaLink)) {
                                                    $pustakaLink = "http://" . $pustakaLink;
                                                }
                    
                                                // Periksa validitas URL
                                                $pustakaLink = filter_var($pustakaLink, FILTER_SANITIZE_URL);
                                                if (!filter_var($pustakaLink, FILTER_VALIDATE_URL)) {
                                                    $pustakaLink = '#';
                                                }
                                            @endphp
                                            <li>
                                                {{ $referensiItem }}
                                                @if(!empty($pustakaLink) && $pustakaLink !== '#')
                                                    - <a href="{{ $pustakaLink }}" target="_blank" style="display: inline-block; max-width: 500px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; text-decoration: none; vertical-align: middle;" title="{{ $pustakaLink }}">{{ $pustakaLink }}</a>
                                                @endif
                                            </li>
                                        @endforeach
                                    @endforeach
                                </ul>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <script>
        function reloadPage() {
            window.location.href = "/user/referensi"; // Atur ini ke URL yang menampilkan semua data tanaman
        }
    </script>
</body>