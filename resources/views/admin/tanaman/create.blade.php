@extends('layouts.dashboard-admin')

@section('contents')
<section id="hero" class="d-flex align-items-center" style="min-height: 100vh; margin-bottom: 0px; position: relative; background: url('{{ asset('assets/img/bg.jpeg') }}') center center/cover no-repeat; background-size: cover;">
    <div class="overlay" style="background-color: rgba(157, 200, 148, 0.8); position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1;"></div>
    <div class="container" style="position: relative; z-index: 2;">
        <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh; width: 100%; padding: 100px 0;">
            <div class="container" style="max-width: 900px; background-color: #fff; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); border-radius: 8px; padding: 20px;">
                <!-- Tombol Kembali -->
                <div class="d-flex justify-content-start mb-4">
                    <a href="javascript:void(0);" onclick="history.back()" style="color: #222021; text-decoration: none; font-size: 16px;">
                        <i class="fas fa-arrow-left" style="margin-right: 7px;"></i> Kembali
                    </a>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 style="font-size: 1.7rem; text-align: center; width: 100%;">Tambahkan Tanaman</h1>
                </div>
                <hr />
                
                <form action="{{ route('admin/tanaman/store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- form input data -->
                    <div class="row mb-3">
                        <div class="col">
                            <label for="nama_latin" class="form-label" style="text-align: center; display: block; font-weight: bold; color: #222021;" >Nama Populer</label>
                            <input type="text" class="form-control" id="nama_latin" name="nama_latin" required style="text-align: center;">
                        </div>
                        <div class="col">
                            <label for="nama_ilmiah" class="form-label" style="text-align: center; display: block; font-weight: bold; color: #222021;">Nama Ilmiah</label>
                            <input type="text" class="form-control" id="nama_ilmiah" name="nama_ilmiah" required style="text-align: center;">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label" style="text-align: center; display: block; font-weight: bold; color: #222021;">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required style="white-space: pre-wrap;"></textarea>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="khasiat" class="form-label" style="text-align: center; display: block; font-weight: bold; color: #222021;">Khasiat</label>
                            <textarea class="form-control" id="khasiat" name="khasiat" rows="3" required style="white-space: pre-wrap;"></textarea>
                        </div>
                        <div class="col">
                            <label for="kandungan_zat" class="form-label" style="text-align: center; display: block; font-weight: bold; color: #222021;">Kandungan Zat</label>
                            <textarea class="form-control" id="kandungan_zat" name="kandungan_zat" rows="3" required style="white-space: pre-wrap;"></textarea>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="dosis" class="form-label" style="text-align: center; display: block; font-weight: bold; color: #222021;">Dosis</label>
                        <textarea class="form-control" id="dosis" name="dosis" rows="3" required style="white-space: pre-wrap;"></textarea>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="perhatian" class="form-label" style="text-align: center; display: block; font-weight: bold; color: #222021;">Perhatian</label>
                            <textarea class="form-control" id="perhatian" name="perhatian" rows="3" required style="white-space: pre-wrap;"></textarea>
                        </div>
                        <div class="col">
                            <label for="cara_budidaya" class="form-label" style="text-align: center; display: block; font-weight: bold; color: #222021;">Cara Budidaya</label>
                            <textarea class="form-control" id="cara_budidaya" name="cara_budidaya" rows="3" required style="white-space: pre-wrap;"></textarea>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="foto_tanaman" class="form-label" style="text-align: center; display: block; font-weight: bold; color: #222021;">Foto Tanaman</label>
                        <input type="file" class="form-control" id="foto_tanaman" name="foto_tanaman[]" multiple required style="text-align: center;">
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary w-50" style="margin-top: 30px;">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection