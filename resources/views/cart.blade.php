@extends('layout/main')

@section('title','Cart')
@section('main')

    <section>
    <div class="container">
      <div class="card my-3" style="min-height:80vh">

        <div class="m-3">
          <p class="h4">Cart</p>
        </div>

        <!-- alert error-->
        <div>
        @if (session('error'))
              <div class="alert alert-danger text-center">
                  {{ session('error') }}
              </div>
        @endif  
        </div>
        <!-- end-alert    -->

        <!-- Table row -->
        <div class="row">
          <div class="col-12 table-responsive">

            <form action="/checkout" method="post">
              @csrf

              <table class="table table-striped">
                  <thead>
                    <tr>
                      <th></th>
                      <th>Produk</th>
                      <th>Jumlah</th>
                      <th>Total Harga</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                <tbody>

                  @foreach($data as $row)
                    <tr>
                      <td><input type="checkbox" name="selected[]" value="{{ $row->id }}"></td>
                      <td>{{ $row->obat }}</td>
                      <td>{{ $row->jumlah }}</td>
                      <td>{{ number_format($row->total_harga, 0, ',', '.') }}</td>
                      <td><a class="btn btn-danger" href="/hapus-cart/{{ $row->id }}"><i class="fas fa-trash"></i></a></td>
                    </tr>
                  @endforeach
                </tbody>
              </table>

              <button class="btn btn-success mx-5 my-3 px-4 float-right"  name="checkout">Checkout</button>
            </form>

          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

      </div>
      
    </div>
  </section>

@endsection