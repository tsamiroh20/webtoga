@extends('layouts.dashboard-user')

@section('contents')
<body style="margin: 0; padding: 0; font-family: Poppins, sans-serif; background-color: #f0f0f0;">
    <section id="hero" class="hero d-flex align-items-center" style="min-height: 100vh; padding: 20px; position: relative; background: url('{{ asset('assets/img/bg.jpeg') }}') center center/cover no-repeat;">
        <div class="overlay" style="background-color: rgba(157, 200, 148, 0.8); position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1;"></div>
        <div class="container" style="position: relative; z-index: 2; max-width: 800px; margin: 0 auto;">

            <!-- Tombol Kembali -->
            <div class="d-flex justify-content-start mb-4">
                <a href="javascript:void(0);" onclick="history.back()" style="color: #222021; text-decoration: none; font-size: 16px;">
                    <i class="fas fa-arrow-left" style="margin-right: 7px;"></i> Kembali
                </a>
            </div>

            <!-- Kotak untuk konten -->
            <div class="card p-4" style="background-color: #fff; box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1); border-radius: 10px;">
                <h3 class="text-center" style="color: #333;">{{ $tanaman->nama_latin }}</h3>

                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <div>
                    
                    @if($tanaman->vidios->isEmpty())
                        <p class="text-center" style="color: #777;">Tidak ada video tersedia untuk tanaman ini.</p>
                    @else
                        <ul class="list-unstyled text-center">
                            @foreach($tanaman->vidios as $video)
                                <li>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#videoModal{{ $video->id }}" style="background-color: #28a745">
                                        Tonton Video
                                    </button>

                                    <!-- Modal untuk menampilkan video -->
                                    <div class="modal fade" id="videoModal{{ $video->id }}" tabindex="-1" aria-labelledby="videoModalLabel{{ $video->id }}" aria-hidden="true" data-bs-backdrop="false">
                                        <div class="modal-dialog modal-lg" style="width: 100%; max-width: 80vw; margin: auto; margin-top: 100px; z-index: 1060; display: flex; justify-content: center; align-items: center;">
                                            <div class="modal-content" style="position: relative; z-index: 1070;">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="videoModalLabel{{ $video->id }}">{{ $tanaman->nama_latin }} - Video</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body d-flex justify-content-center">
                                                    <iframe width="100%" height="400" src="{{ str_replace('youtu.be', 'youtube.com/embed', $video->video_url) }}" frameborder="0" allowfullscreen></iframe>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                    
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </section>
</body>
@endsection
