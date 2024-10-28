@extends('layouts.dashboard-user')

@section('contents')
<body style="margin: 0; padding: 0; font-family: Poppins, sans-serif; background-color: #f0f0f0;">
    <section id="hero" class="hero d-flex align-items-center" style="min-height: 100vh; margin-bottom: 0px; padding: 10px; position: relative; background: url('{{ asset('assets/img/bg.jpeg') }}') center center/cover no-repeat;">
        <div class="overlay" style="background-color: rgba(157, 200, 148, 0.8); position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1;"></div>
            <div class="container" style="position: relative; z-index: 2;">
        <div class="d-flex justify-content-center" style="width: 100%; padding: 80px 0;">
            <div class="container" data-aos="fade-up" style="max-width: 800px; background-color: #fff; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); border-radius: 8px; padding: 20px;">
                <button type="button" class="btn-close" aria-label="Close" onclick="window.location.href='/homeuser'"></button>
                <h1 style="text-align: center; font-size: 1.7rem; font-weight: bold;">Halaman tanggapan</h1>
                <hr/>

                <!-- Notifikasi Sukses -->
                @if (session('success'))
                <div class="alert alert-success" role="alert" style="position: relative; display: flex; align-items: center;">
                    <span>{{ session('success') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="margin-left: auto;"></button>
                </div>
                @endif

                <!-- form untuk mengirim tanggapan -->
                <form action="{{ route('user.tanggapan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-4">
                        <div class="col">
                            <label for="nama" class="form-label" style="margin-top: 50px; text-align: center; display: block; font-weight: bold; color: #222021;">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="col">
                            <label for="umur" class="form-label" style="margin-top: 50px; text-align: center; display: block; font-weight: bold; color: #222021;">Umur</label>
                            <input type="number" class="form-control" id="umur" name="umur" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="kritik" class="form-label" style="margin-top: 50px; text-align: center; display: block; font-weight: bold; color: #222021;">Kritik</label>
                        <textarea class="form-control" id="kritik" name="kritik" rows="3" required style="white-space: pre-wrap;"></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="saran" class="form-label" style="margin-top: 30px; text-align: center; display: block; font-weight: bold; color: #222021;">Saran</label>
                        <textarea class="form-control" id="saran" name="saran" rows="3" required style="white-space: pre-wrap;"></textarea>
                    </div>
                    <div class="d-flex justify-content-center" style="margin-top: 50px; margin-bottom: 30px;">
                        <button type="submit" class="btn btn-primary w-50">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </section>
</body>

@endsection
