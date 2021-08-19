@extends('layout/main-auth')

@section('title', 'Login')

@section('main')

<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Login</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">

      <p class="login-box-msg">Login untuk melakukan pembelian</p>
	
	 <!-- alert sukses-->
    <div>
    @if (session('success'))
          <div class="alert alert-success" style="font-size: 0.85rem"> 
              {{ session('success') }}
          </div>
    @endif  
    </div>
    <!-- end-alert    -->

    <!-- alert error-->
    <div>
    @if (session('error'))
          <div class="alert alert-danger" style="font-size: 0.85rem">
              {{ session('error') }}
          </div>
    @endif  
    </div>
    <!-- end-alert    -->

      <form action="/login" method="post">
      	@csrf
        <div class="input-group mb-3">
          <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" autofocus>
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

        <button type="submit" class="btn btn-primary btn-block" name="login">Login</button>
      </form>

      <div class="py-3">
        <p class="text-center">Belum punya akun? <a href="/registration">Daftar</a></p>
      </div>
      
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->


@endsection