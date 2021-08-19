@extends('layout/main')

@section('title',$obat->obat)

@section('main')

  <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-sm-6">
              <h3 class="d-inline-block d-sm-none">{{ $obat->obat }}</h3>
              <div class="col-12">
                <img src="/assets/img/obat/{{ $obat->foto }}" class="product-image p-3" alt="Product Image">
              </div>
            </div>
            <div class="col-12 col-sm-6">
              <h3 class="my-3">{{ $obat->obat }}</h3>
              <p>{{ $obat->deskripsi }}</p>

              @if($obat->stok > 0)
                
                <label><h5>Stok : </h5></label>
                <div class="bg-success py-2 px-3 mb-4">
                  <h4 class="mb-0">
                    {{ $obat->stok }}
                  </h4>
                </div>

                <label><h5>Harga : </h5></label>
                <div class="bg-success py-2 px-3">
                  <h4 class="mb-0">
                    Rp {{ number_format($obat->harga, 0, ',', '.') }}
                  </h4>
                </div>

              @else

                <label><h5>Stok : </h5></label>
                <div class="bg-secondary py-2 px-3 mb-4">
                  <h4 class="mb-0">
                    Habis
                  </h4>
                </div>

                <label><h5>Harga : </h5></label>
                <div class="bg-secondary py-2 px-3">
                  <h4 class="mb-0">
                    Rp {{ number_format($obat->harga, 0, ',', '.') }}
                  </h4>
                </div>
              @endif

              <hr>
				
				      <div class="card card-default">
	              <div class="card-header">
	                <h3 class="card-title">Data Pembelian</h3>
	              </div>
	              <!-- /.card-header -->
	              <!-- form start -->
	              <form role="form" action="/beli" method="post">
                  <!-- token csrf -->
                  @csrf

                  <input type="hidden" name="id_obat" value="{{ $obat->id }}">

	                <div class="card-body">
	                  <div class="form-group">
	                    <label for="jumlah">Jumlah pembelian</label>
	                    <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Masukkan jumlah pembelian" required="" max="{{ $obat->stok }}">
	                  </div>
	                  <div class="form-group">
	                    <label for="alamat">Alamat pengiriman</label>
	                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan alamat pengiriman" required="">
	                  </div>
	                </div>
	                <!-- /.card-body -->

	                <div class="card-footer">
                    @if($obat->stok > 0)
	                     <button type="submit" class="btn btn-block btn-success" name="beli">Beli Sekarang</button>
                    
                    @else
                        <div class="bg-secondary m-1">
                          <h3 class="text-center p-4">Stok Habis</h3>
                        </div>
                       <a href="/"><button type="button" class="btn btn-block btn-success m-1">Cari obat lainnya</button></a>

                    @endif

	                </div>
	              </form>
	            </div>
	            <!-- /.card -->

            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->

@endsection