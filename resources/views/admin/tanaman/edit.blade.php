@extends('layouts.dashboard-admin')

@section('contents')
<section id="hero" class="d-flex align-items-center" style="min-height: 100vh; margin-bottom: 0px; margin-top: 30px; position: relative; background: url('{{ asset('assets/img/bg.jpeg') }}') center center/cover no-repeat; background-size: cover;">
    <div class="overlay" style="background-color: rgba(157, 200, 148, 0.8); position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1;"></div>
    <div class="container" style="position: relative; z-index: 2;">
        <div class="d-flex justify-content-center align-items-center w-100">
            <div class="container my-5" style="max-width: 900px; background-color: #fff; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); border-radius: 8px; padding: 20px;">
                <!-- Tombol Kembali -->
                <div class="d-flex justify-content-start mb-4">
                    <a href="javascript:void(0);" onclick="history.back()" style="color: #222021; text-decoration: none; font-size: 16px;">
                        <i class="fas fa-arrow-left" style="margin-right: 7px;"></i> Kembali
                    </a>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 style="font-size: 1.7rem; text-align: center; width: 100%;">Data Edit Tanaman</h1>
                </div>
                <hr /> 
                <form action="{{ route('admin/tanaman/update', $tanaman->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- form update/edit data -->
                    <div class=" row mb-3">
                        <div class="col">
                            <label for="nama_latin" class="form-label" style="font-weight: bold; color: #222021;">Nama Populer</label>
                            <input type="text" name="nama_latin" id="nama_latin" value="{{ $tanaman->nama_latin }}" class="form-control">
                        </div>
                        <div class="col">
                            <label for="nama_ilmiah" class="form-label" style="font-weight: bold; color: #222021;">Nama Ilmiah</label>
                            <input type="text" name="nama_ilmiah" id="nama_ilmiah" value="{{ $tanaman->nama_ilmiah }}" class="form-control">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label" style="font-weight: bold; color: #222021;">Deskripsi</label>
                            <textarea id="deskripsi" name="deskripsi" rows="3" class="form-control">{{ $tanaman->deskripsi }}</textarea>
                    </div>

                    <div class=" row mb-3">
                        <div class="col">
                            <label for="khasiat" class="form-label" style="font-weight: bold; color: #222021;">Khasiat</label>
                            <textarea id="khasiat" name="khasiat" rows="3" class="form-control">{{ $tanaman->khasiat }}</textarea>
                        </div>
                        <div class="col">
                            <label for="kandungan_zat" class="form-label" style="font-weight: bold; color: #222021;">Kandungan Zat</label>
                            <textarea id="kandungan_zat" name="kandungan_zat" rows="3" class="form-control">{{ $tanaman->kandungan_zat }}</textarea>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="dosis" class="form-label" style="font-weight: bold; color: #222021;">Dosis</label>
                        <textarea id="dosis" name="dosis" rows="3" class="form-control" style="white-space: pre-wrap;">{{ $tanaman->dosis }}</textarea>
                    </div>

                    <div class=" row mb-3">
                        <div class="col">
                            <label for="perhatian" class="form-label" style="font-weight: bold; color: #222021;">Perhatian</label>
                            <textarea id="perhatian" name="perhatian" rows="3" class="form-control">{{ $tanaman->perhatian }}</textarea>
                        </div>
                        <div class="col">
                            <label for="cara_budidaya" class="form-label" style="font-weight: bold; color: #222021;">Cara Budidaya</label>
                            <textarea id="cara_budidaya" name="cara_budidaya" rows="3" class="form-control">{{ $tanaman->cara_budidaya }}</textarea>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="foto_tanaman" class="form-label" style="font-weight: bold; color: #222021;">Foto Tanaman</label>
                        <input type="file" name="foto_tanaman[]" id="foto_tanaman" class="form-control" style="text-align: center;" multiple>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label" style="font-weight: bold; color: #222021;">Foto yang Sudah Diunggah</label>
                        <div>
                            @foreach($tanaman->fotos as $foto)
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('storage/' . $foto->path) }}" alt="Foto Tanaman" style="width: 100px; height: auto;">
                                    <label class="form-check-label ms-2">
                                        <input type="checkbox" name="delete_foto[]" value="{{ $foto->id }}" class="form-check-input">
                                        Hapus
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary w-50" style="margin-top: 30px;">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
    
@endsection