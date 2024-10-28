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
                    <h1 style="font-size: 1.7rem; text-align: center; width: 100%;">Tambahkan Data Penyajian</h1>
                </div>
                <hr />
                
                <form action="{{ route('admin/penyajian/store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- form input data -->
                    <div class="mb-3" style="text-align: center; margin-top: 30px;">
                        <label for="tanaman_id" class="form-label" style="text-align: center; display: block; font-weight: bold; color: #222021;">Nama Tanaman</label>
                        <select class="form-control" id="tanaman_id" name="tanaman_id" required>
                            <option value="">Pilih Nama Tanaman</option>
                            @foreach($tanamen as $tanaman)
                                <option value="{{ $tanaman->id }}">{{ $tanaman->nama_latin }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col" style="text-align: center; margin-top: 30px;">
                        <label for="nama_penyakit" class="form-label" style="text-align: center; display: block; font-weight: bold; color: #222021;">Nama Penyakit</label>
                        <input type="text" name="nama_penyakit" id="nama_penyakit" class="form-control" required style="white-space: pre-wrap;">
                    </div>
                    <div class="mb-3" style="text-align: center; margin-top: 30px;">
                        <label for="cara_penyajian" class="form-label" style="text-align: center; display: block; font-weight: bold; color: #222021;">Cara Penyajian</label>
                        <textarea class="form-control" id="cara_penyajian" name="cara_penyajian" rows="3" required style="white-space: pre-wrap;"></textarea>
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