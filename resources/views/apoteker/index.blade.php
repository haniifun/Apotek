@extends('layout/main')

@section('title','Pesanan')

@section('main')

<section>
    <div class="container">
      <div class="card my-3" style="min-height:80vh">


        <div class="mt-4 px-3">
        	<div>
          		<h4>Daftar Pesanan</h4>
        	</div>
		
			<!-- alert sukses-->
		    <div class="p-1">
		    @if (session('success'))
		          <div class="alert alert-success w-100"> 
		              {{ session('success') }}
		          </div>
		    @endif  
		    </div>
		    <!-- end-alert    -->

          <nav class="w-100">
            <div class="nav nav-tabs" id="product-tab" role="tablist">
              <a class="nav-item nav-link active" id="pesanan-tab" data-toggle="tab" href="#pesanan" role="tab" aria-controls="pesanan" aria-selected="true">Pesanan</a>
              <a class="nav-item nav-link" id="dikirim-tab" data-toggle="tab" href="#dikirim" role="tab" aria-controls="dikirim" aria-selected="false">Dikirim</a>
              <a class="nav-item nav-link" id="selesai-tab" data-toggle="tab" href="#selesai" role="tab" aria-controls="selesai" aria-selected="false">Selesai</a>
            </div>
          </nav>


          <div class="tab-content p-3" id="nav-tabContent" style="width: 100%">
            <div class="tab-pane fade show active" id="pesanan" role="tabpanel" aria-labelledby="pesanan-tab">
              <div class="table-responsive">
                <table class="table table-striped" width="100%">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>No Invoice</th>
                    <th>Total Harga</th>
                    <th>Pelanggan</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; ?>
                    @foreach ($pesanan as $row)
                      <tr>
                        <td width="3%">{{ $no++ }}</td>
                        <td width="35%">{{ $row->invoice }}</td>
                        <td width="13%">Rp {{ number_format($row->total,0,",",".") }}</td>
                        <td width="13%">{{ $row->name }}</td>
                        <td width="24%">
                          <div class="row">
                              
                            <a href="/invoice/{{ $row->invoice }} " class="btn btn-info m-1">Detail</a>
                            <form action="/kirim-pesanan" method="post">
                              @csrf

                              <input type="hidden" name="invoice" value="{{ $row->invoice }}">
                              <button type="submit" class="btn btn-success m-1" name="kirim">Kirim pesanan</button>
                            </form>
                          </div>
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
                    <th>No Invoice</th>
                    <th>Total Harga</th>
                    <th>Pelanggan</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>

                    <?php $no=1 ?>
                    @foreach ($dikirim as $row)
                      <tr>
                        <td width="5%">{{ $no++ }} </td>
                        <td width="35%">{{ $row->invoice }} </td>
                        <td width="15%">Rp {{ number_format($row->total,0,",",".") }}</td>
                        <td width="20%"> {{ $row->name }}</td>
                        <td width="20%">
                            <a href="/invoice/{{ $row->invoice }} " class="btn btn-info m-1">Detail</a>
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
                    <th>No Invoice</th>
                    <th>Total Harga</th>
                    <th>Pelanggan</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; ?>
                    @foreach ($selesai as $row)
                      <tr>
                        <td width="5%">{{ $no++ }} </td>
                        <td width="35%">{{ $row->invoice }} </td>
                        <td width="15%">Rp {{ number_format($row->total,0,",",".") }}</td>
                        <td width="20%"> {{ $row->name }}</td>
                        <td width="20%">
                            <a href="/invoice/{{ $row->invoice }} " class="btn btn-info m-1">Detail</a>
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