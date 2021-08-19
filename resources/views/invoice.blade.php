@extends('layout/main')

@section('title','Invoice')

@section('main')

 <section class="content my-3">
      <div class="container">
        <div class="row">
          <div class="col-12">


            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i> INVOICE
                    <small class="float-right">Tanggal : {{ date('d/m/Y', strtotime($data->first()->tanggal)) }}</small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info my-2">
                <div class="col-sm-8 invoice-col">
                  Dikirim ke :
                  <address>
                    <strong>{{ $data->first()->name }}</strong><br>
                    {{ $data->first()->alamat_pengiriman }}
                  </address>
                </div>
                <div class="col-sm-4 invoice-col">
                  <table width="100%">
                    <tr>
                      <td width="38%">Nama Pelanggan</td>
                      <td width="3%">:</td>
                      <td>{{ $data->first()->name }}</td>
                    </tr>
                    <tr>
                      <td>Email</td>
                      <td>:</td>
                      <td>{{ $data->first()->email }}</td>
                    </tr>
                    <tr>
                      <td>Nomor HP</td>
                      <td>:</td>
                      <td>{{ $data->first()->no_telp }}</td>
                    </tr>
                    
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
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

                      @foreach($data as $row)
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
                        <td ><h5 class="font-weight-bold text-success">Rp {{ number_format($data->first()->total,0, ",", ".") }}</h5></td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-md-6 text-center">
                  <p class="lead font-weight-bold">Pembayaran:</p>
                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                    Pembayaran dilakukan dengan tranfer ke rekening berikut. 
                  </p>
                  <div>
                    <h6 class="my-1 py-0 ">Bank ..........</h6>
                    <h5 class="my-0 py-0 font-weight-bold">01902182901</h5>
                    <p class="my-0 py-0 ">a.n</p>
                    <h6 class="my-0 py-0 ">Pemilik rekening</h6>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                  @if (session()->get('role_id') == 2)

                  	<!-- jika belum dibayar tampilkan button upload pembayaran -->
                    @if($data->first()->status == 'Belum dibayar')
                      <div class="my-2">
                        <a href="/pembayaran/{{ $data->first()->invoice}}" class="btn btn-block btn-success "><i class="far fa-credit-card"></i> Upload Bukti Pembayaran
                        </a>
                      </div>
                    @endif

                    <div class="my-2">
                      <a href="/history" class="btn btn-block btn-primary" style="margin-right: 5px;">
                        Riwayat Transaksi
                      </a>
                    </div>

                  @else

                    <div class="my-2">
                      <a href="/apoteker" class="btn btn-block btn-success" style="margin-right: 5px;">
                        Kembali ke Daftar Pesanan
                      </a>
                    </div>

                  @endif
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection