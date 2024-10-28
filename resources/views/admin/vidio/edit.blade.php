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
                    <h1 style="font-size: 1.7rem; text-align: center; width: 100%;">Edit Data Video</h1>
                </div>
                <hr />
                
                <!-- Notifikasi Error -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Notifikasi Sukses -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('admin.vidio.update', $vidio->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <!-- Form Edit Data -->
                    <div class="mb-3" style="text-align: center; margin-top: 30px;">
                        <label for="tanaman_id" class="form-label" style="font-weight: bold; color: #222021;">Nama Tanaman</label>
                        <select class="form-control" id="tanaman_id" name="tanaman_id" required>
                            <option value="">Pilih Nama Tanaman</option>
                            @foreach($tanamen as $tanaman)
                                <option value="{{ $tanaman->id }}" {{ $vidio->tanaman_id == $tanaman->id ? 'selected' : '' }}>{{ $tanaman->nama_latin }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3" style="text-align: center; margin-top: 30px;">
                        <label for="video_url" class="form-label" style="font-weight: bold; color: #222021;">Link Video</label>
                        <input type="text" name="video_url" id="video_url" style="text-align: center;" class="form-control" value="{{ old('video_url', $vidio->video_url) }}" required>
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
