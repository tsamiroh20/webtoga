<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <section id="hero" class="hero d-flex align-items-center" style="min-height: 100vh; margin-bottom: 0px; position: relative; background: url('assets/img/bg.jpeg') center center/cover no-repeat;">
        <div class="overlay" style="background-color: rgba(157, 200, 148, 0.8); position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1;"></div>
        <div class="container" style="position: relative; z-index: 2;">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <h3 class="card-title text-center mb-4">Login</h3>
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <button type="button" class="btn-close" aria-label="Close" onclick="window.location.href='/'"></button>
                            <h6 class="h4 mb-3 fw-normal text-center">Masuk ke akun</h6>

                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between align-items-center" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
 
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between align-items-center" role="alert">
                                    <span>{{ session('success') }}</span>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <form method="post" action="{{ route('login.action') }}">
                                @csrf
                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Error!</strong>
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="nama@gmail.com" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required>
                                </div>
                                <div class="d-flex justify-content-end align-items-center mb-3" >
                                    <a href="{{ route('lupapassword') }}" class="text-decoration-none float-right">Lupa password?</a>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Masuk</button>
                                </div>
                                <div class="mt-3 text-center">
                                    <p class="mb-0">Belum mempunyai akun? <a href="{{ route('register') }}" class="text-decoration-none">Daftar</a></p>
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
