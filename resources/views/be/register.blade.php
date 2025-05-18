<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Sign Up Your Account</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./be/images/favicon.png">
    <link href="./be/css/style.css" rel="stylesheet">
</head>

<body class="h-100">
    <div class="authincation h-100">
        <div class="container-fluid h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-8">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <h4 class="text-center mb-4">Sign up your account</h4>
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                                        @csrf
                                        
                                        <!-- User Fields -->
                                        <div class="form-group">
                                            <label><strong>Nama Lengkap</strong></label>
                                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Masukkan Nama Lengkap Anda" required>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Email</strong></label>
                                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Masukkan Email Anda" required>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Password</strong></label>
                                            <input type="password" class="form-control" name="password" placeholder="Buat Password Anda" required>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Konfirmasi Password</strong></label>
                                            <input type="password" class="form-control" name="password_confirmation" placeholder="Konfirmasi Password Anda" required>
                                        </div>
                                        
                                        <!-- Pelanggan Fields -->
                                        <div class="form-group">
                                            <label><strong>Nomor Telepon</strong></label>
                                            <input type="tel" class="form-control" name="no_hp" value="{{ old('no_hp') }}" placeholder="Nomor Telepon Aktif" required>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Alamat</strong></label>
                                            <textarea class="form-control" name="alamat" placeholder="Masukkan Alamat Anda" required>{{ old('alamat') }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Masukkan Foto Profil</strong></label>
                                            <input type="file" class="form-control" name="foto">
                                        </div>

                                        <div class="text-center mt-4">
                                            <button type="submit" class="btn btn-primary btn-block">Sign me up</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p>Already have an account? <a class="text-primary" href="{{ route('login') }}">Sign in</a></p>
                                    </div>
                                    <div class="new-account mt-3">
                                        <p>Kembali Menuju <a class="text-primary" href="/">Home</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="./be/vendor/global/global.min.js"></script>
    <script src="./be/js/quixnav-init.js"></script>
    <!--endRemoveIf(production)-->
</body>

</html>