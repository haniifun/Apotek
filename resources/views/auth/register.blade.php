@extends('layout/main-auth')

@section('title', 'Registrasi')

@section('main')

<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Registrasi</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">

      <p class="login-box-msg">Buat akun untuk melakukan pembelian</p>

        <!-- alert sukses-->
        <div>
        @if (session('success'))
              <div class="alert alert-success" style="font-size: 0.85rem">
                  {{ session('success') }}
              </div>
        @endif  
        </div>
        <!-- end-alert    -->

      <form action="/registration" method="post">
        <!-- token csrf -->
        @csrf

        <div class="input-group mb-3">
          <input type="text" class="form-control @error('emailnamaLengkap') is-invalid @enderror" placeholder="Nama Lengkap" name="namaLengkap" autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        @error('namaLengkap')
          <div class="form-group small text-danger">{{ $message }}</div>
        @enderror

        <div class="input-group mb-3">
          <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        @error('email')
          <div class="form-group small text-danger">{{ $message }}</div>
        @enderror

        <div class="input-group mb-3">
          <input type="text" class="form-control @error('nohp') is-invalid @enderror" placeholder="Nomor Handphone" name="nohp">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
        </div>
        @error('nohp')
          <div class="form-group small text-danger">{{ $message }}</div>
        @enderror

        <div class="input-group mb-3">
          <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        @error('password')
          <div class="form-group small text-danger">{{ $message }}</div>
        @enderror

        <div class="input-group mb-3">
          <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Konfirmasi Password" name="password_confirmation">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        @error('password_confirmation')
          <div class="form-group small text-danger">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-primary btn-block" name="register">Buat Akun</button>  
      </form>

      <div class="py-3">
        <p class="text-center">Sudah punya akun? <a href="/login">Login</a></p>
      </div>

      
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

@endsection