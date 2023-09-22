<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Sistem Keuangan Pribadi</title>
    <link href="assets-login/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets-login/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets-login/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    {{-- sweet alert --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.0/dist/sweetalert2.min.css">

    {{-- kode icon show password --}}
<style>
  .form-group {
    position: relative;
  }

  .show-password-label {
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    cursor: pointer;
  }

  .active-eye {
    color: orange;
  }
</style>
{{--  --}}
  </head>
  <body>
    <section class="form-01-main">
      <div class="form-cover">
        @yield('content')
      </div>
    </section>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.0/dist/sweetalert2.min.js"></script>
@if(Session::has('loginError'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Login Gagal',
            text: '{{ Session::get("loginError") }}',
            timer: 3000, // Tampilkan alert selama 3 detik
            showConfirmButton: false
        });
    </script>
@endif

{{-- kode icon show password --}}
<script>
  const passwordInput = document.getElementById("password");
  const showPasswordCheckbox = document.getElementById("showPassword");
  const eyeIcon = document.getElementById("eyeIcon");

  eyeIcon.addEventListener("click", function () {
    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      eyeIcon.classList.add("active-eye");
    } else {
      passwordInput.type = "password";
      eyeIcon.classList.remove("active-eye");
    }
  });
</script> 
  </body>
</html>