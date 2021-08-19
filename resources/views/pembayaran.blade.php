@extends('layout/main')

@section('title','Pembayaran')

@section('main')

<section style="min-height: 85vh">
    <div class="container my-2 p-3">
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">Konfirmasi Pembayaran</h3>
        </div>

        <div class="m-3 p-1">

          <label class="d-block">Pilih invoice transaksi yang dibayar</label>
          <div class="btn-group">
            <button type="button" class="btn btn-default text-success px-5 font-weight-bold dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{ $transaksi->first()->invoice }}
            </button>
            <div class="dropdown-menu">
              @foreach($invoices as $row)
                <a class="dropdown-item" href="/pembayaran/{{ $row->invoice }}">{{ $row->invoice }}</a>
              @endforeach
            </div>
          </div>
        </div>

        <hr>

            

        <!-- alert success-->
        <div>
        @if (session('success'))
              <div class="m-3 btn btn-block btn-outline-success text-center">
                  {{ session('success') }}
              </div>
        @endif  
        </div>
        <!-- end-alert    -->

          <div class="row mx-3">
            <label for="konfirmasi">Transaksi yang akan dibayar</label>
            <div class="col-12 table-responsive">
              <table class="table table-striped">
                <thead>
                <tr>
                  <th>Produk</th>
                  <th>Jumlah</th>
                  <th>Harga satuan</th>
                  <th>Total</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($transaksi as $row)
                    <tr>
                      <td>{{ $row->obat }}</td>
                      <td>{{ $row->jumlah }}</td>
                      <td>Rp {{ number_format($row->harga,0, ",", ".") }}</td>
                      <td>Rp {{ number_format($row->total_harga,0, ",", ".") }}</td>
                    </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="3"><h5 class="font-weight-bold float-right text-success">Total Pembayaran : </h5></td>
                    <td ><h5 class="font-weight-bold text-success">Rp {{ number_format($row->total,0, ",", ".") }}</h5></td>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>


        <form class="form-horizontal" action="/pembayaran" method="post" enctype="multipart/form-data">
          @csrf

          <input type="hidden" name="invoice" value="{{ $transaksi->first()->invoice }}">
          <div class="card-body">
            <div class="form-group">
              <label for="konfirmasi">Upload Bukti Pembayaran <span class="text-danger">*(.jpg, .jpeg, .pdf, .png)</span></label>
              <input type="file" class="form-control-file" id="konfirmasi" name="bukti" required>
            </div>
          </div>
          <div class="form-group mx-3">
            <button type="submit" class="btn btn-success" name="konfirmasi">Upload Bukti Pembayaran</button>
          </div>
          <!-- /.card-footer -->
        </form>


      </div>
    </div>
  </section>    
 

@endsection