<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="/assets/css/adminlte.min.css">
    <link rel="stylesheet" href="/assets/css/font.css">
    <link rel="stylesheet" href="/assets/plugins/fontawesome-free/css/all.min.css">

    <title>@yield('title')</title>
  </head>
  <body class="bg-light">
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
      <div class="container">
    <!-- <a class="navbar-brand" href="#">Navbar</a> -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link font-weight-bold" href="/">Beranda</a>
            </li>
            @if(session()->get('role_id') == 1)
              <li class="nav-item active">
                <a class="nav-link font-weight-bold" href="/list-obat">List Obat</a>
              </li>
              <li class="nav-item active">
                <a class="nav-link font-weight-bold" href="/apoteker">Pesanan</a>
              </li>
            @endif
        </ul>

        <!-- Example single danger button -->

          @if(session()->has('email'))
            <div class="btn-group">
              <button type="button" class="btn btn-default text-success px-3 font-weight-bold dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ session()->get('email') }}
              </button>
              <div class="dropdown-menu">
                @if(session()->get('role_id') == 2)
                  <a class="dropdown-item" href="/history">Riwayat Transaksi</a>
                  <a class="dropdown-item" href="/cart">Cart</a>
                    <div class="dropdown-divider"></div>
                @endif
                <a class="dropdown-item" href="/logout">Logout</a>
              </div>
            </div>
          @else
            <a href="/login" class="btn btn-default text-success px-3 font-weight-bold">Login</a>
          @endif
      </div>
    </div>
  </nav>

  @yield('main')

  <div class="bg-success pt-3 pb-1">
      <p class="text-white text-center" >Copyright © 2020 Sehat.com</p>
  </div>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="/assets/js/jquery-3.5.1.slim.min.js"></script>
  <script src="/assets/js/popper.min.js"></script>
  <script src="/assets/js/bootstrap.min.js"></script>
  <!-- AdminLTE App -->

  <script src="/assets/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="/assets/js/demo.js"></script>
  
  <script src="/assets/js/demo.js"></script>
  <!-- Bootstrap 4 -->
  <script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  
</body>
</html>
