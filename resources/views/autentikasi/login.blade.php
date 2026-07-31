<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        {{ config('app.name') }} | Login App
    </title>

    <!-- SB Admin CSS -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height:100vh;">
            <div class="col-lg-5 col-md-7">

                @if (session('error'))
                    <div class="alert alert-danger">
                        <strong>Gagal,</strong> {{ session('error') }}
                    </div>
                @elseif(session('success'))
                    <div class="alert alert-success">
                        <strong>Berhasil,</strong> {{ session('success') }}
                    </div>
                @endif

                <div class="card shadow-lg border-0">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <i class="fas fa-industry fa-4x text-primary mb-3"></i>
                            <h3 class="font-weight-bold">
                                Smart Manufacturing
                            </h3>
                            <p class="text-muted mb-0">
                                Dashboard Monitoring Produksi
                            </p>
                        </div>
                        <form action="{{ url('/auth/login') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username"
                                    class="form-control @error('username') is-invalid @enderror"
                                    placeholder="Masukkan Username" value="{{ old('username') }}">

                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Masukkan Password">

                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fas fa-sign-in-alt mr-2"></i>
                                Login
                            </button>
                        </form>
                    </div>
                </div>
                <div class="text-center mt-3 text-white">
                    Smart Manufacturing Dashboard © {{ date('Y') }}
                </div>
            </div>
        </div>
    </div>
    <!-- SB Admin JS -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
</body>

</html>
