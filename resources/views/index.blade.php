@extends('layout/main')

@section('title','Beranda')

@section('main')

  <section>
    <div class="container">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="assets/img/slider-1.jpg" alt="First slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="assets/img/dokter1.jpg" alt="Second slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="assets/img/obat2.jpg" alt="Third slide">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>

    </div>    
  </section>

  <section style="background-color: #efefef">
    <div class="container">
      <div class="pt-4 text-center">
        <h3 class="font-weight-bold">List Obat</h3>
        <p>Kami menyediakan berbagai jenis obat-obatan</p>
      </div>
      <div class="row">
        @foreach($data as $row)
          <div class="col-lg-3 col-md-4 col-sm my-1">
            <div class="card">
                <a href="/beli/{{$row->id}}"><img class="card-img-top p-2" src="/assets/img/obat/{{ $row->foto }}" alt="Card image cap"></a>
                <div class="card-body py-1" >
                  <div style="min-height: 50px" class="mb-2">
                    <a class="text-dark" href="/beli/{{ $row->id }}"><h5 class="font-weight-bold text-center">{{ $row->obat }}</h5></a>
                  </div>
                  <p class="text-center text-success">Rp {{ number_format($row->harga, 0, ',', '.')}}</p>
                  <p><a href="/beli/{{ $row->id }}" class="btn btn-block btn-success">Beli sekarang</a></p>
                </div>
            </div>
          </div>
        @endforeach
      </div>
      
    </div>
  </section>

@endsection