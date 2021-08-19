@extends('layout/main')

@section('title', $obat->obat)

@section('main')

  <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body">
          <div class="row p-3">
            <div class="col-12 col-sm-6">
              <h3 class="d-inline-block d-sm-none">{{ $obat->obat }}</h3>
              <div class="col-12">
                <img src="/assets/img/obat/{{ $obat->foto }}" class="product-image p-3" alt="Product Image">
              </div>
            </div>
            <div class="col-12 col-sm-6">
              <h3 class="my-3">{{ $obat->obat }}</h3>
              <p>{{ $obat->deskripsi }}</p>

              <label><h5>Stok : </h5></label>
              <div class="bg-success py-2 px-3 mb-4">
                <h4 class="mb-0">
                	{{ $obat->stok }}
                </h4>
              </div>

              <label><h5>Harga : </h5></label>
              <div class="bg-success py-2 px-3">
                <h4 class="mb-0">
                  Rp {{ number_format($obat->harga ,0,",",".") }}
                </h4>
              </div>

            <a href="/list-obat" class="btn btn-secondary float-right mt-5">Kembali ke halaman list obat</a>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection