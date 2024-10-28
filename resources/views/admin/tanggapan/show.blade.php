@extends('layouts.dashboard-admin')

@section('contents')
<section id="hero" class="d-flex align-items-center" style="min-height: 100vh; margin-bottom: 0px; padding: 70px; position: relative; background: url('{{ asset('assets/img/bg.jpeg') }}') center center/cover no-repeat; background-size: cover;">
    <div class="overlay" style="background-color: rgba(157, 200, 148, 0.8); position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1;"></div>
    <div class="container" style="position: relative; z-index: 2;">
        <div class="container my-4" style="background-color: #fff; padding: 20px; border-radius: 10px; margin-top: 20px; margin-bottom: 20px;">
            <!-- Tombol Kembali -->
            <div class="d-flex justify-content-start mb-4">
                <a href="javascript:void(0);" onclick="history.back()" style="color: #222021; text-decoration: none; font-size: 16px;">
                    <i class="fas fa-arrow-left" style="margin-right: 7px;"></i> Kembali
                </a>
            </div>

            <h1 style="text-align: center; font-size: 1.7rem;">Detail Tanggapan</h1>
            <hr />

            <!-- form untuk menampilkan informasi -->
            <form>
                <div class="border-bottom" style="padding-bottom: 1.5rem; border-bottom: 1px solid #dee2e6;">
                    <div class="row g-3 mt-3" style="text-align: center; margin-top: 1rem;">
                        <div class="col-md-6" style="margin-bottom: 1rem;">
                            <label class="form-label text-dark" style="font-weight: bold; color: #222021;">Nama</label>
                            <div class="mt-2" style="margin-top: .5rem;">
                                {{ $tanggapan->nama }}
                            </div>
                        </div>
                        <div class="col-md-6" style="margin-bottom: 1rem;">
                            <label class="form-label text-dark" style="font-weight: bold; color: #222021;">Umur</label>
                            <div class="mt-2" style="margin-top: .5rem;">
                                {{ $tanggapan->umur }}
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 mt-3" style="text-align: center; margin-top: 1rem;">
                        <div class="col-md-6" style="margin-bottom: 1rem;">
                            <label class="form-label text-dark" style="font-weight: bold; color: #222021;">Kritik</label>
                            <div class="mt-2" style="margin-top: .5rem;">
                                {{ $tanggapan->kritik }}
                            </div>
                        </div>
                        <div class="col-md-6" style="margin-bottom: 1rem;">
                            <label class="form-label text-dark" style="font-weight: bold; color: #222021;">Saran</label>
                            <div class="mt-2" style="margin-top: .5rem;">
                                {{ $tanggapan->saran }}
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 mt-3" style="text-align: center; margin-top: 1rem;">
                        <div class="col-md-12" style="margin-bottom: 1rem;">
                            <label class="form-label text-dark" style="font-weight: bold; color: #222021;">Tanggal Ditambahkan</label>
                            <div class="mt-2" style="margin-top: .5rem;">
                                {{ $tanggapan->created_at->format('d M Y') }}
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection