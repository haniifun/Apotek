<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Obat;

class ApotekerController extends Controller
{
	public function index(Request $request)
	{
	    // jika belum login maka tidak bisa membeli
		if(!$request->session()->has('email')){
			return redirect('/login');
		}

		// jika yang login bukan admin/apoteker
		if($request->session()->get('role_id') != 1) {
			return redirect('/');
		}

		// data pesanan
        $pesanan = DB::table('transaksi')->distinct()->select('invoice.*')
                                ->join('invoice','transaksi.invoice','=','invoice.invoice')
                                ->join('users','transaksi.id_user','=','users.id')
                                ->where('status', 'Sedang diproses')
                                ->select('users.name', 'invoice.*')
                                ->get();

        // data transaksi yang sedang dikirim
        $dikirim = DB::table('transaksi')->distinct()->select('invoice.*')
                                ->join('invoice','transaksi.invoice','=','invoice.invoice')
                                ->join('users','transaksi.id_user','=','users.id')
                                ->where('status', 'Dikirim')
                                ->select('users.name', 'invoice.*')
                                ->get();

        // data transaksi yang sudah selesai
        $selesai = DB::table('transaksi')->distinct()->select('invoice.*')
                                ->join('invoice','transaksi.invoice','=','invoice.invoice')
                                ->join('users','transaksi.id_user','=','users.id')
                                ->where('status', 'Selesai')
                                ->select('users.name', 'invoice.*')
                                ->get();

		return view('/apoteker/index', compact('pesanan','dikirim','selesai'));
	}

	public function kirim(Request $request)
	{
	    // jika belum login maka tidak bisa membeli
		if(!$request->session()->has('email')){
			return redirect('/login');
		}

		// jika yang login bukan admin/apoteker
		if($request->session()->get('role_id') != 1) {
			return redirect('/');
		}

		// update status transaksi menjadi "Dikirim"
		DB::table('transaksi')
	                ->where('invoice', $request->invoice)
	                ->update([
	                    'status' => 'Dikirim'
	                ]);

		return redirect('/apoteker')->with('success','Berhasil! Transaksi '.$request->invoice.' dikirim.');
	}

	public function listObat(Request $request)
	{
	    // jika belum login maka tidak bisa membeli
		if(!$request->session()->has('email')){
			return redirect('/login');
		}

		// jika yang login bukan admin/apoteker
		if($request->session()->get('role_id') != 1) {
			return redirect('/');
		}

		// data obat
		$data = Obat::all();

		return view('/apoteker/list-obat', compact('data'));
	}

	public function detailObat(Request $request, $id)
	{
	    // jika belum login maka tidak bisa membeli
		if(!$request->session()->has('email')){
			return redirect('/login');
		}

		// jika yang login bukan admin/apoteker
		if($request->session()->get('role_id') != 1) {
			return redirect('/');
		}

		// data obat berdasarkan id
		$obat = Obat::all()->where('id', $id)->first();

		return view('/apoteker/detail-obat', compact('obat'));
	}

	public function tambahObat(Request $request)
	{
	    // jika belum login maka tidak bisa membeli
		if(!$request->session()->has('email')){
			return redirect('/login');
		}

		// jika yang login bukan admin/apoteker
		if($request->session()->get('role_id') != 1) {
			return redirect('/');
		}

		// tangkap data foto
		$file = $request->file('foto');
        $nama_file = time()."_".$file->getClientOriginalName();

        // simpan gambar
        $file->move('assets/img/obat/', $nama_file);

		DB::table('obat')->insert([
			'obat' => $request->nama_obat,
			'deskripsi' => $request->deskripsi_obat,
			'harga' => $request->harga,
			'stok' => $request->stok,
			'foto' => $nama_file
		]);

		return redirect('/list-obat')->with('success','Data obat berhasil ditambahkan.');
	}

	public function updateObat(Request $request)
	{
	    // jika belum login maka tidak bisa membeli
		if(!$request->session()->has('email')){
			return redirect('/login');
		}

		// jika yang login bukan admin/apoteker
		if($request->session()->get('role_id') != 1) {
			return redirect('/');
		}

		// id obat
        $id = $request->id_obat;
        $foto_obat = Obat::all()->where('id', $id)->first()->foto;

        if ($request->hasFile('foto')) {
            $this->validate($request, [
                'foto' => 'file|image|mimes:jpeg,png,jpg',
            ]);

            // menangkap input file foto
            $file = $request->file('foto');

            $nama_foto = time()."_".$file->getClientOriginalName();

            // simpan foto baru
            $file->move('assets/img/obat/', $nama_foto);

            // cek apakah ada file foto tersebut dalam folder
            if(file_exists(storage_path('../public/assets/img/obat/').$foto_obat))
            {
                // hapus foto lama dalam folder
                unlink(storage_path('../public/assets/img/obat/'.$foto_obat));
            }
        } else {
            $nama_foto = $foto_obat;
        }


        // update data
        DB::table('obat')
              ->where('id', $id)
              ->update([
                    'obat' => $request->nama_obat, 
                    'deskripsi' => $request->deskripsi_obat, 
                    'harga' => $request->harga, 
                    'stok' => $request->stok, 
                    'foto' => $nama_foto, 
                ]);

		return redirect('/list-obat')->with('success','Data obat berhasil diupdate.');
	}

	public function hapusObat(Request $request)
	{
	    // jika belum login maka tidak bisa membeli
		if(!$request->session()->has('email')){
			return redirect('/login');
		}

		// jika yang login bukan admin/apoteker
		if($request->session()->get('role_id') != 1) {
			return redirect('/');
		}

        // ambil nama foto 
        $foto = Obat::all()->where('id', $request->id_obat)->first()->foto;

		// hapus data oabt di database
        Obat::where('id', $request->id_obat)->delete();

        // jika ada foto pada folder images
        if (file_exists(storage_path('../public/assets/img/obat/').$foto))
        {
            // hapus foto dalam folder images
            unlink(storage_path('../public/assets/img/obat/'.$foto));
        }

		return redirect('/list-obat')->with('success','Data obat berhasil dihapus.');
	}


}
