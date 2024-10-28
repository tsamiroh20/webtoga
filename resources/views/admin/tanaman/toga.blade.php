@extends('layouts.dashboard-admin')

@section('contents')
<section id="hero" class="d-flex align-items-center" style="min-height: 100vh; margin-bottom: 0px; padding: 50px; position: relative; background: url('{{ asset('assets/img/bg.jpeg') }}') center center/cover no-repeat; background-size: cover;">
    <div class="overlay" style="background-color: rgba(157, 200, 148, 0.8); position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1;"></div>
    <div class="container" style="position: relative; z-index: 2;">
        <div class="d-flex justify-content-center align-items-center w-100">
            <div class="container my-5" style="max-width: 1200px; background-color: #fff; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); border-radius: 8px; padding: 20px;">
                
                <button type="button" class="btn-close" aria-label="Close" onclick="window.location.href='/homeadmin'"></button>
                
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 style="font-size: 1.7rem; text-align: center; width: 100%;">Data Tanaman Toga</h1>
                    <a href="{{ route('admin/tanaman/create') }}" class="btn btn-primary" style="font-size: 1rem;">Tambah Tanaman</a>
                </div>
                
                <!-- Form Pencarian -->
                <div class="d-flex justify-content-center mb-4">
                    <form class="d-flex" action="{{ route('admin/datasearch') }}" method="GET" style="width: 70%; border-radius: 50px; overflow: hidden; background-color: #fff; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
                        <input class="form-control" type="search" placeholder="Cari nama tanaman..." aria-label="Search" name="query" style="border: none; box-shadow: none; border-radius: 50px 0 0 50px; flex-grow: 1; padding: 10px 20px;">
                        <button class="btn btn-outline-success" type="submit" style="border: none; border-radius: 0 50px 50px 0; background-color: #28a745; color: white; padding: 10px 20px; transition: background-color 0.3s;"
                            onmousedown="this.style.backgroundColor='#218838';" onmouseup="this.style.backgroundColor='#28a745';" onmouseleave="this.style.backgroundColor='#28a745';"
                            onmouseover="this.style.backgroundColor='green';" onmouseout="this.style.backgroundColor='#28a745';">Cari</button>
                    </form>
                </div>
                
                <!-- Notifikasi tanaman -->
                @if (isset($message) || session('success') || session('delete_success'))
                    <div class="alert alert-dismissible fade show" role="alert" 
                        style="{{ isset($message) ? 'background-color: #ffcccb; color: #721c24;' : 'background-color: #d4edda; color: #155724;' }}">
                        {{ $message ?? session('success') ?? session('delete_success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" onclick="reloadPage()"></button>
                    </div>
                @endif
                <hr />
                
                <!--untuk menampilkan data didalam tabel-->
                <div class="table-container" style="overflow-x: auto;">
                    <table class="table table-striped table-bordered table-hover text-start" style="min-width: 100%; table-layout: fixed;">
                        <thead style="background-color: #28a745; color: #fff;">
                            <tr>
                                <th scope="col" style="text-align: center; width: 50px;">No</th>
                                <th scope="col" style="text-align: center; width: 100px;">Nama Populer</th>
                                <th scope="col" style="text-align: center; width: 150px;">Nama Ilmiah</th>
                                <th scope="col" style="text-align: center; width: 300px;">Deskripsi</th>
                                <th scope="col" style="text-align: center; width: 300px;">Khasiat</th>
                                <th scope="col" style="text-align: center; width: 300px;">Kandungan Zat</th>
                                <th scope="col" style="text-align: center; width: 300px;">Dosis</th>
                                <th scope="col" style="text-align: center; width: 300px;">Perhatian</th>
                                <th scope="col" style="text-align: center; width: 300px;">Cara Budidaya</th>
                                <th scope="col" style="text-align: center; width: 200px;">Foto Tanaman</th>
                                <th scope="col" style="text-align: center; width: 240px;">Action</th>
                            </tr>
                        </thead>
                        <!--untuk menyimpan isi tabel dari model yg digunakan-->
                        <tbody>
                            @foreach($tanaman as $toga)
                            <tr class="bg-white border-bottom">
                                <th scope="row" class="fw-medium text-dark" style="text-align: center;">
                                    {{ $loop->iteration }}
                                </th>
                                <td style="text-align: center;">{{ $toga->nama_latin }}</td>
                                <td style="text-align: center;">{{ $toga->nama_ilmiah }}</td>
                                <td style="text-align: center; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $toga->deskripsi }}</td>
                                <td style="text-align: center; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $toga->khasiat }}</td>
                                <td style="text-align: center; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $toga->kandungan_zat }}</td>
                                <td style="text-align: center; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $toga->dosis }}</td>
                                <td style="text-align: center; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $toga->perhatian }}</td>
                                <td style="text-align: center; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $toga->cara_budidaya }}</td>
                                <td style="text-align: center;">
                                    @foreach ($toga->fotos as $foto)
                                        <img src="{{ asset('storage/' . $foto->path) }}" alt="Foto Tanaman" style="width: 100px; height: auto;">
                                    @endforeach
                                </td>
                                <td class="w-36" style="text-align: center;">
                                    <div class="d-flex align-items-center h-14 pt-2">
                                        <a href="{{ route('admin/tanaman/show', $toga->id) }}" class="btn btn-primary me-2">Detail</a>
                                        <a href="{{ route('admin/tanaman/edit', $toga->id) }}" class="btn btn-success me-2">Edit</a>
                                        <form action="{{ route('admin/tanaman/destroy', $toga->id) }}" method="POST" onsubmit="return confirm('Delete?')" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    function reloadPage() {
        window.location.href = "/admin/tanaman"; // Atur ini ke URL yang menampilkan semua data tanaman
    }
</script>
@endsection