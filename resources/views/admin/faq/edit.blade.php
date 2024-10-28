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
                    <h1 style="font-size: 1.7rem; text-align: center; width: 100%;">Edit FAQ</h1>
                </div>
                <hr />
                
                <form action="{{ route('admin/faq/update', $faq->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- form update/edit data -->
                    <div class="mb-3">
                        <label for="pertanyaan" class="form-label" style="font-weight: bold; color: #222021;">Pertanyaan</label>
                        <textarea id="pertanyaan" name="pertanyaan" rows="3" class="form-control">{{ $faq->pertanyaan }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="jawaban" class="form-label" style="font-weight: bold; color: #222021;">Jawaban</label>
                        <textarea id="jawaban" name="jawaban" rows="3" class="form-control">{{ $faq->jawaban }}</textarea>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary w-50">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection