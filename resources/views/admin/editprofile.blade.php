@extends('layouts.dashboard-admin')

@section('contents')
<section id="hero" class="d-flex align-items-center" style="min-height: 100vh; margin-bottom: 0px; position: relative; background: url('{{ asset('assets/img/bg.jpeg') }}') center center/cover no-repeat;">
    <div class="overlay" style="background-color: rgba(157, 200, 148, 0.8); position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1;"></div><!--memberikan efek visual pada latar belakang-->
    <div class="container" style="position: relative; z-index: 2;">
        <div class="d-flex justify-content-center" style="width: 100%; padding: 80px 0;">
            <div class="container" data-aos="fade-up" style="max-width: 600px; background-color: #fff; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); border-radius: 8px; padding: 20px;">
                
                <!-- Tombol Kembali -->
                <div class="d-flex justify-content-start mb-4">
                    <a href="javascript:void(0);" onclick="history.back()" style="color: #222021; text-decoration: none; font-size: 16px;">
                        <i class="fas fa-arrow-left" style="margin-right: 7px;"></i> Kembali
                    </a>
                </div>
                
                <h1 style="text-align: center; font-size: 1.7rem; font-weight: bold;">Edit Profile</h1>
                <hr/>

                <!-- Formulir untuk mengedit profil -->
                <form action="{{ route('admin/profile/update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST') <!-- Method POST untuk update -->

                    <!-- Input Nama -->
                    <div class="mb-3"> 
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Bio -->
                    <div class="mb-3">
                        <label for="bio" class="form-label">Bio</label>
                        <textarea class="form-control @error('bio') is-invalid @enderror" id="bio" name="bio">{{ old('bio', $user->profile->bio ?? '') }}</textarea>
                        @error('bio')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Kelamin -->
                    <div class="mb-3">
                        <label for="kelamin" class="form-label">Kelamin</label>
                        <select class="form-control @error('kelamin') is-invalid @enderror" id="kelamin" name="kelamin">
                            <option value="-" {{ old('kelamin', $user->profile->kelamin ?? '-') == '-' ? 'selected' : '' }}>Pilih</option>
                            <option value="Laki-laki" {{ old('kelamin', $user->profile->kelamin ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('kelamin', $user->profile->kelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('kelamin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Umur -->
                    <div class="mb-3">
                        <label for="umur" class="form-label">Umur</label>
                        <input type="number" class="form-control @error('umur') is-invalid @enderror" id="umur" name="umur" value="{{ old('umur', $user->profile->umur ?? '') }}">
                        @error('umur')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Foto Profil -->
                    <div class="mb-3">
                        <label for="foto_profile" class="form-label">Foto Profil</label>
                        <input type="file" class="form-control @error('foto_profile') is-invalid @enderror" id="foto_profile" name="foto_profile">
                        @error('foto_profile')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @if($user->profile && $user->profile->foto_profile)
                            <div class="mt-3">
                                <img src="{{ asset('storage/' . $user->profile->foto_profile) }}" alt="Current Profile Picture" class="img-thumbnail" width="150">
                            </div>
                        @endif
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary w-50" style="margin-top: 50px; background-color: #28a745;">Update Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection