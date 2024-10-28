<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Lupa Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <section id="hero" class="hero d-flex align-items-center" style="min-height: 100vh; margin-bottom: 0px; position: relative; background: url('assets/img/bg.jpeg') center center/cover no-repeat;">
        <div class="overlay" style="background-color: rgba(157, 200, 148, 0.8); position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1;"></div>
        <div class="container" style="position: relative; z-index: 2;">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <button type="button" class="btn-close" aria-label="Close" onclick="window.location.href='/login'"></button>
                            <h6 class="h4 mb-3 fw-normal text-center"><strong>Lupa Password ?</strong></h6>

                            <p class="fw-normal text-center">Silahkan masukkan email anda untuk permintaan pengaturan ulang kata sandi</p>
                            
                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between align-items-center" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            @if ($errors->any())
                                <div>
                                    @foreach ($errors->all() as $error)
                                        <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between align-items-center" role="alert">
                                            {{ $error }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            
                            <form action="{{ route('kirimlinkresetemail') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="nama@gmail.com" required>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Kirim Tautan Reset Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>