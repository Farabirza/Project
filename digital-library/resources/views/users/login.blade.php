<!-- Check wether this user is authenticated -->
@auth
<?php header("Location: /books"); die(); ?>
@endauth
<!-- Check wether this user is authenticated -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Vendor JS Files -->
  <script src="{{ asset('/vendor/jquery/jquery-3.6.0.min.js') }}"></script>

  <!-- Favicons -->
  <link href="{{ asset('/img/logo/logo_book_small.png') }}" rel="icon">
  <link href="{{ asset('/img/logo/logo_book.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
  <link href="{{ asset('/vendor/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('/css/style.css') }}" rel="stylesheet">

<style>
    img { height: 100%; width: 100%; border-radius: 1rem 0 0 1rem; }
    body { background: url("{{asset('img/bg/bg_trans-60.png')}}") repeat, url("{{asset('img/hero-bg.jpg')}}"); background-size: cover; }
    #img-front { overflow: hidden; }
</style>

<title>Digital Library | {{$page_title}}</title>

</head>
<body>
<section class="vh-100">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div id="img-front" class="col-md-6 col-lg-5 d-none d-md-block">
              <img src="{{asset('img/hero-bg.jpg')}}" alt="login form">
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

                <form action="/login" method="POST">
                @csrf

                  @if(session('success'))
                  <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                  @endif
                  @if(session('error'))
                  <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
                  @endif
                  <h3 class="display-6 mb-20">Pribadi Depok Digital Library</h3>
                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>

                  <div class="form-outline mb-4">
                    <label class="form-label">Email address</label>
                    <div class="form-group d-flex">
                      <input type="text" name="email1" class="form-control form-control-lg col" value="{{ old('email') }}" autofocus>
                      <span>&ensp;</span>
                      <select name="email2" class="form-control form-control-lg col">
                        <option value="@pribadidepok.sch.id">@pribadidepok.sch.id</option>
                        <option value="@gmail.com">@gmail.com</option>
                      </select>
                    </div>
                    @error('email1')
                    <br><div class="alert alert-danger">{{$message}}</div>
                    @enderror
                  </div>

                  <div class="form-outline mb-4">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control form-control-lg">
                    @error('password')
                    <br><div class="alert alert-danger">{{$message}}</div>
                    @enderror
                  </div>

                  <div class="form-outline mb-4">
                    <p class="pb-lg-2" style="color: #393f81;"><input type="checkbox" name="remember" value="true" class="mr-8"> Remember me</p>
                  </div>
                  <div class="pt-1 mb-4">
                    <button class="btn btn-outline-dark btn-lg btn-block" type="submit"><i class='bx bx-log-in' ></i> Login</button>
                  </div>
                  <a class="small text-muted" href="#!">Forgot password?</a>
                  <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="/register"><b>Register here</b></a> or <a href="/books"><b>Login as a guest</b></a></p>
                  <a href="#!" class="small text-muted">Terms of use.</a>
                  <a href="#!" class="small text-muted">Privacy policy</a>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Vendor JS Files -->
<script src="{{ asset('/vendor/purecounter/purecounter.js') }}"></script>
<script src="{{ asset('/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('/vendor/typed.js') }}/typed.min.js') }}"></script>
<script src="{{ asset('/vendor/waypoints/noframework.waypoints.js') }}"></script>
<script src="{{ asset('/vendor/php-email-form/validate.js') }}"></script>
<script src="{{ asset('/vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>

<!-- Template Main JS File -->
<script src="{{ asset('/js/main.js') }}"></script>

</body>

</html>