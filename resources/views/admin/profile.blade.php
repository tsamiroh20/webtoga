@extends('layouts.dashboard-admin')

@section('contents')
<section id="hero" class="d-flex align-items-center" style="min-height: 100vh; margin-bottom: 0px; position: relative; background: url('{{ asset('assets/img/bg.jpeg') }}') center center/cover no-repeat;">
    <div class="overlay" style="background-color: rgba(157, 200, 148, 0.8); position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1;"></div> <!--memberikan efek visual pada latar belakang-->
    <div class="container" style="position: relative; z-index: 2;">
        <div class="d-flex justify-content-center align-items-center" style="width: 100%; padding: 80px 0;">
            <div class="container" data-aos="fade-up" style="max-width: 800px; background-color: #fff; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); border-radius: 8px; padding: 40px;">
                <button type="button" class="btn-close" aria-label="Close" onclick="window.location.href='/homeadmin'"></button>
                <h1 style="text-align: center; font-size: 1.7rem; font-weight: bold;">Halaman Profile</h1>
                <hr/>
                <!--menampilkan pesan sukses-->
                @if(session('success')) 
                    <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between align-items-center" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="text-center mb-4">
                    <!--menampilkan foto profile jika ada, jika tidak maka foto default-->
                    @if (isset($user->profile) && $user->profile->foto_profile)
                        <img src="{{ asset('storage/' . $user->profile->foto_profile) }}" alt="Foto Profil Pengguna" style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%;">
                    @else
                        <img src="{{ asset('images/default-profile.png') }}" alt="Foto Profil Default" style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%;">
                    @endif
                    <!--menampilkan nama dan email-->
                    <h5 class="mt-3">{{ $user->name }}</h5>
                    <p>{{ $user->email }}</p> 
                    <a href="{{ route('admin/editprofile', $user->id) }}" class="btn btn-success me-2" style="background-color: #28a745;"
                        onmouseover="this.style.backgroundColor='green';" onmouseout="this.style.backgroundColor='#28a745';">Edit Profile</a>
                </div>
                
                <!--menampilkan informasi berikut jika ada-->
                <div class="profile-info mt-4 text-center">
                    <p style="margin-top: 50px;"><strong>Bio:</strong></p>
                    <p style="white-space: pre-line;">{{ $user->profile->bio ?? '-' }}</p>
                    <p><strong>Jenis Kelamin:</strong> {{ $user->profile->kelamin ?? '-' }}</p>
                    <p class="ms-3"><strong>Umur:</strong> {{ $user->profile->umur ?? '-' }}</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
