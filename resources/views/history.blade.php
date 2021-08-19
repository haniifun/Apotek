@extends('layout/main')

@section('title','Riwayat pembelian')

@section('main')

  <section>
    <div class="container">
      <div class="card my-2" style="min-height:80vh">

        <div class="mt-4 px-4">
          <div class="block">
            <h4 class="font-weight-bold my-3">Riwayat Transaksi</h4>
          </div>

          <!-- alert success-->
          <div class="p-1">
          @if (session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
          @endif  
          </div>
          <!-- end-alert    -->

          <nav class="w-100">
            <div class="nav nav-tabs" id="product-tab" role="tablist">
              <a class="nav-item nav-link active" id="belum-bayar-tab" data-toggle="tab" href="#belum-bayar" role="tab" aria-controls="belum-bayar" aria-selected="true">Belum dibayar</a>
              <a class="nav-item nav-link" id="diproses-tab" data-toggle="tab" href="#diproses" role="tab" aria-controls="diproses" aria-selected="false">Sedang diproses</a>
              <a class="nav-item nav-link" id="dikirim-tab" data-toggle="tab" href="#dikirim" role="tab" aria-controls="dikirim" aria-selected="false">Dikirim</a>
              <a class="nav-item nav-link" id="selesai-tab" data-toggle="tab" href="#selesai" role="tab" aria-controls="selesai" aria-selected="false">Selesai</a>
            </div>
          </nav>
          <div class="tab-content py-3" id="nav-tabContent" style="width: 100%">
            <div class="tab-pane fade show active" id="belum-bayar" role="tabpanel" aria-labelledby="belum-bayar-tab">
              <div class="table-responsive">
                <table class="table table-striped" width="100%">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nomor Invoice</th>
                    <th>Total Harga</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  	<?php $no=1 ?>
                    @foreach($belumBayar as $row)
                      <tr>
                        <td width="5%">{{ $no++ }}</td>
                        <td width="45%">{{ $row->invoice }}</td>
                        <td width="20%">Rp {{ number_format($row->total,0,",",".") }}</td>
                        <td width="20%">
                          <a href="/invoice/{{ $row->invoice }}" class="btn btn-info">Detail</a>
                          <a href="/pembayaran/{{ $row->invoice }}" class="btn btn-success">Bayar</a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <div class="tab-pane fade" id="diproses" role="tabpanel" aria-labelledby="diproses-tab">
              <div class="table-responsive">
                <table class="table table-striped" width="100%">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nomor Invoice</th>
                    <th>Total Harga</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $no=1 ?>
                    @foreach($diproses as $row)
                      <tr>
                        <td width="5%">{{ $no++ }}</td>
                        <td width="45%">{{ $row->invoice }}</td>
                        <td width="20%">Rp {{ number_format($row->total,0,",",".") }}</td>
                        <td width="20%">
                          <a href="/invoice/{{ $row->invoice }}" class="btn btn-info">Detail</a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <div class="tab-pane fade" id="dikirim" role="tabpanel" aria-labelledby="dikirim-tab">
              <div class="table-responsive">
                <table class="table table-striped" width="100%">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nomor Invoice</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $no=1 ?>
                    @foreach($dikirim as $row)
                      <tr>
                        <td width="5%">{{ $no++ }}</td>
                        <td width="35%">{{ $row->invoice }}</td>
                        <td width="15%">Rp {{ number_format($row->total,0,",",".") }}</td>
                        <td width="15%">Sedang dikirim</td>
                        <td>
                          <div class="row">
                            <form action="/terima-pesanan" method="post">
                              @csrf
                              <input type="hidden" name="invoice" value="{{ $row->invoice }}">
                              <button type="submit" class="btn btn-success m-1" name="konfirmasi">Terima pesanan</button>
                            </form>
                          </div>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <div class="tab-pane fade" id="selesai" role="tabpanel" aria-labelledby="selesai-tab">
              <div class="table-responsive">
                <table class="table table-striped" width="100%">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nomor Invoice</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $no=1 ?>
                    @foreach($selesai as $row)
                      <tr>
                        <td width="5%">{{ $no++ }}</td>
                        <td width="35%">{{ $row->invoice }}</td>
                        <td width="15%">Rp {{ number_format($row->total,0,",",".") }}</td>
                        <td width="15%">Pesanan diterima</td>
                        <td width="20%">
                          <a href="/invoice/{{ $row->invoice }}" class="btn btn-info">Detail</a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </section>

@endsection