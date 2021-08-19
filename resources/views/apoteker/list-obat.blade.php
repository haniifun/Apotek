@extends('layout/main')

@section('title','List Obat')


@section('main')
<section>
	<div class="container">
	  <div class="card my-3">

	    <div class="row p-4">
	      <div class="col-12">
	        <h4>
	          List Obat
	          <small class="float-right"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-tambah"><i class="fas fa-plus"></i> Tambah Data</button></small>
	        </h4>

	          <!-- Modal tambah data obat -->
	          <div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	            <div class="modal-dialog modal-lg" role="document">
	              <div class="modal-content">
	                <div class="modal-header">
	                  <h5 class="modal-title" id="exampleModalLabel">Tambah Data Obat</h5>
	                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">&times;</span>
	                  </button>
	                </div>
	                <form method="post" action="/tambah-obat" enctype="multipart/form-data">
	                  @csrf

	                  <div class="modal-body">
	                      <div class="modal-body">
	                          <div class="form-group">
	                            <label for="nama_obat">Nama obat</label>
	                            <input type="text" class="form-control" id="nama_obat" name="nama_obat" placeholder="Nama obat" required autofocus>
	                          </div>

	                          <div class="form-group">
	                            <label for="deskripsi_obat">Deskripsi</label>
				                <textarea class="form-control" name="deskripsi_obat" id="deskripsi_obat" required></textarea>
	                          </div>
	                          <div class="row">
	                          	<div class="col-sm-6">
		                          <div class="form-group">
		                            <label for="stok">Stok Obat</label>
		                            <input type="number" class="form-control" id="stok" name="stok" placeholder="Stok" required>
		                          </div>
	                          	</div>
	                          	<div class="col-sm-6">
		                          <div class="form-group">
		                            <label for="harga">Harga</label>
		                            <input type="number" class="form-control" id="harga" name="harga" placeholder="harga" required>
		                          </div>                
	                          	</div>
	                          </div>
	                          <div class="form-group">
	                            <label for="foto">Foto obat <span class="text-danger">*(.jpg, .jpeg, .png)</span></label>
	                            <input type="file" class="form-control-file" id="foto" name="foto" required>
	                          </div>
	                      </div>
	                  </div>
	                  <div class="modal-footer">
	                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
	                    <button type="submit" class="btn btn-success" name="tambah">Simpan</button>
	                  </div>
	                </form>
	              </div>
	            </div>
	          </div>
	          <!-- end modal -->


	      </div>
	    </div>
	    <!-- Table row -->
	    <div class="row mx-3">

			<!-- alert sukses-->
		    <div class="p-1">
		    @if (session('success'))
		          <div class="alert alert-success w-100"> 
		              {{ session('success') }}
		          </div>
		    @endif  
		    </div>
		    <!-- end-alert    -->

	      <div class="col-12 table-responsive">
	        <table class="table table-striped">
	          <thead>
	          <tr>
	            <th>No</th>
	            <th>Foto</th>
	            <th>Nama Obat</th>
	            <th>Stok</th>
	            <th>Harga</th>
	            <th>Aksi</th>
	          </tr>
	          </thead>
	          <tbody>
	            <?php $no = 1 ?>
	            @foreach ($data as $row)
	              <tr>
	                <td>{{ $no++ }}</td>
	                <td><img src="/assets/img/obat/{{ $row->foto }}" width="50px" ></td>
	                <td>{{ $row->obat }}</td>
	                <td>{{ $row->stok }}</td>
	                <td>Rp {{ number_format($row->harga,0,",",".") }}</td>
	                <td>
	                    <a href="/detail-obat/{{ $row->id }}"><button class="btn btn-info"><i class="fas fa-search"></i></button></a>
	                    <button class="btn btn-warning" data-toggle="modal" data-target="#edit{{ $row->id }}"><i class="fas fa-pencil-alt"></i></button>
	                    <button class="btn btn-danger" data-toggle="modal" data-target="#hapus{{ $row->id }}"><i class="fas fa-trash"></i></button>
	                </td>
	              </tr>


	              <!-- Modal edit data obat -->
	              <div class="modal fade" id="edit{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                <div class="modal-dialog" role="document">
	                  <div class="modal-content">
	                    <div class="modal-header">
	                      <h5 class="modal-title" id="exampleModalLabel">Edit Data Obat</h5>
	                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                        <span aria-hidden="true">&times;</span>
	                      </button>
	                    </div>
	                    <form method="post" action="/update-obat" enctype="multipart/form-data">
	                   	  @csrf

	                      <input type="hidden" name="id_obat" value="{{ $row->id }}">
	                      <div class="modal-body">
	                          <div class="modal-body py-0">
	                              <div class="form-group">
	                                <label for="nama_obat">Nama obat</label>
	                                <input type="text" class="form-control" id="nama_obat" name="nama_obat" placeholder="Nama obat" required value="{{ $row->obat }}">
	                              </div>
	                              <div class="form-group">
	                                <label for="deskripsi_obat">Deskripsi</label>
	                                <textarea class="form-control" name="deskripsi_obat" id="deskripsi_obat" required>{{ $row->deskripsi }}</textarea>
	                              </div>
	                              <div class="form-group">
	                                <label for="stok">Stok Obat</label>
	                                <input type="number" class="form-control" id="stok" name="stok" placeholder="Stok" required value="{{ $row->stok }}">
	                              </div>
	                              <div class="form-group">
	                                <label for="harga">Harga</label>
	                                <input type="number" class="form-control" id="Harga" name="harga" placeholder="Harga" required value="{{ $row->harga }}">
	                              </div>                
	                              <div class="form-group">
	                                <label for="foto">Foto obat <span class="text-danger">*(.jpg, .jpeg, .png)</span></label>
	                                <input type="file" class="form-control-file" id="foto" name="foto">
	                              </div>
	                          </div>
	                      </div>
	                      <div class="modal-footer">
	                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
	                        <button type="submit" class="btn btn-success" name="edit">Simpan perubahan</button>
	                      </div>
	                    </form>
	                  </div>
	                </div>
	              </div>
	              <!-- end modal edit -->


	              <!-- Modal hapus data obat -->
	              <div class="modal fade" id="hapus{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                <div class="modal-dialog" role="document">
	                  <div class="modal-content">
	                    <div class="modal-header">
	                      <h5 class="modal-title" id="exampleModalLabel">Hapus Data Obat</h5>
	                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                        <span aria-hidden="true">&times;</span>
	                      </button>
	                    </div>
	                    <form method="post" action="/hapus-obat">
	                    	@csrf

	                      <input type="hidden" name="id_obat" value="{{ $row->id }}">

	                      <p class="m-3">Anda yakin ingin menghapus <b>{{ $row->obat }}?</b></p>

	                      <div class="modal-footer">
	                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
	                        <button type="submit" class="btn btn-danger" name="hapus">Hapus</button>
	                      </div>
	                    </form>
	                  </div>
	                </div>
	              </div>
	              <!-- end modal hapus -->



	            @endforeach
	          </tbody>
	        </table>
	      </div>
	      <!-- /.col -->
	    </div>
	    <!-- /.row -->

	  </div>
	  
	</div>
</section>

@endsection

