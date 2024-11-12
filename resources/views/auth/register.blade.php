<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="{{ asset('img/logo/siu.png') }}" type="image/x-icon">
  <title>LearnAccess - Register</title>
  <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('css/ruang-admin.min.css') }}" rel="stylesheet">
</head>

<body class="bg-gradient-login">
  <!-- Register Content -->
  <div class="container-login">
    <div class="row justify-content-center">
      <div class="col-xl-6 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Register</h1>
                  </div>
                  <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group">
                      <label>Nama</label>
                      <input type="text" class="form-control" name="name" id="exampleInputFirstName" placeholder="Masukkan Nama Lengkap" required>
                    </div>
                    <div class="form-group">
                      <label>Alamat Email</label>
                      <input type="email" class="form-control" name="email" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Masukkan Alamat Email" required>
                    </div>
                    <div class="form-group">
                      <label>Password</label>
                      <input type="password" class="form-control" name="password" id="exampleInputPassword" placeholder="Kata Sandi " required>
                    </div>
                    <div class="form-group">
                      <label>Ulangi Password</label>
                      <input type="password" class="form-control" name="password_confirmation" id="exampleInputPasswordRepeat" placeholder="Ulangi Kata Sandi" required>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>
                    <hr>
                  </form>
                  <div class="text-center">
                    <a class="font-weight-bold small" href="{{ route('login') }}">Sudah memiliki akun?</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Register Content -->
  
  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('js/ruang-admin.min.js') }}"></script>
</body>
</html>
