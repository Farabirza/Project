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
  <link href="{{ asset('/vendor/datatables/datatables.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('/css/style.css') }}" rel="stylesheet">

  <title>Digital Library | {{$page_title}}</title>
  
@stack('css-styles')

</head>
<body>
<!-- ======= Script ======= -->
<script type="text/javascript">
    AOS.init({ once: true,  easing: 'ease-in-out-sine' });
</script>
<!-- ======= Script end ======= -->

<!-- ======= Mobile nav toggle button ======= -->
<i class="bi bi-list mobile-nav-toggle d-xl-none"></i>

<!-- ======= Header ======= -->
@include('layouts.partials.header')
<!-- ======= Header end ======= -->

<!-- ======= Main content ======= -->
<main id="main">
@yield('content') <!-- Contents here! -->
</main>
<!-- ======= Main content end ======= -->

<!-- ======= Footer ======= -->
@include('layouts.partials.footer')
<!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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
<script src="{{ asset('/vendor/datatables/datatables.min.js') }}"></script>

<!-- Template Main JS File -->
<script src="{{ asset('/js/main.js') }}"></script>

<script type="text/javascript">
$(document).ready(function(){
  new PureCounter({
      // Setting that can't' be overriden on pre-element
      selector: '.purecounter',		// HTML query selector for spesific element

      // Settings that can be overridden on per-element basis, by `data-purecounter-*` attributes:
      start: 0, 			            // Starting number [unit]
      end: 100, 			            // End number [unit]
      duration: 1, 	                // The time in seconds for the animation to complete [seconds]
      delay: 3, 			            // The delay between each iteration (the default of 10 will produce 100 fps) [miliseconds]
      once: true, 		            // Counting at once or recount when the element in view [boolean]
      repeat: false, 		            // Repeat count for certain time [boolean:false|seconds]
      decimals: 0, 		            // How many decimal places to show. [unit]
      legacy: true,                   // If this is true it will use the scroll event listener on browsers
      filesizing: false, 	            // This will enable/disable File Size format [boolean]
      currency: false, 	            // This will enable/disable Currency format. Use it for set the symbol too [boolean|char|string]
      separator: false, 	            // This will enable/disable comma separator for thousands. Use it for set the symbol too [boolean|char|string]
  });
  @if(session('success'))
    Swal.fire({
      icon: 'success',
      title: "{{ session('success') }}",
      showConfirmButton: false,
      timer: 2000
    })
  @endif
});
</script>

@stack('scripts')
</body>

</html>