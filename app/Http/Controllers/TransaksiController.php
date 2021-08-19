<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Obat;
use App\Transaksi;
use App\Invoice;

class TransaksiController extends Controller
{


    //
    public function index()
    {
    	// ambil data obat dari database
    	$data = Obat::all();
    	
    	return view('index', compact('data'));
    }

    public function pageBeli(Request $request, $id)
    {
    	// jika belum login maka tidak bisa membeli
    	if(!$request->session()->has('email')){
    		return redirect('/login');
    	}

        // jika yang login bukan pelanggan
        if($request->session()->get('role_id') != 2) {
            return redirect('/');
        }

    	// ambil 1 baris data di tabel obat yang id = $id
    	$obat = Obat::all()->where('id', $id)->first();

    	return view('beli', compact('obat'));
    }

    public function beli(Request $request) 
    {
    	// jika belum login maka tidak bisa membeli
    	if(!$request->session()->has('email')){
    		return redirect('/login');
    	}

        // jika yang login bukan pelanggan
        if($request->session()->get('role_id') != 2) {
            return redirect('/');
        }

    	$request->validate([
    		'jumlah' => 'required|numeric',
    		'alamat' => 'required'
    	]);

    	// ambil data obat sesuai id_obat
    	$obat = Obat::all()->where('id', $request->id_obat)->first();

    	// id user diambil dari session id_user
    	$id_user = $request->session()->get('id_user');

    	$id_obat = $obat->id;
    	$jumlah = $request->jumlah;
    	$total_harga = $request->jumlah * $obat->harga;
    	$alamat_pengiriman = $request->alamat;

    	DB::table('transaksi')->insert([
    		'id_user' => $id_user,
    		'id_obat' => $id_obat,
    		'jumlah' => $jumlah,
    		'total_harga' => $total_harga,
    		'alamat_pengiriman' => $alamat_pengiriman,
    		'status' => 'Cart',
    		'invoice' => '-'
    	]);

    	return redirect('/cart');
    }

    public function cart(Request $request)
    {
    	// jika belum login maka tidak bisa membeli
    	if(!$request->session()->has('email')){
    		return redirect('/login');
    	}

        // jika yang login bukan pelanggan
        if($request->session()->get('role_id') != 2) {
            return redirect('/');
        }

    	// id user diambil dari session id_user
    	$id_user = $request->session()->get('id_user');

    	$data = DB::table('transaksi')
    				->join('obat', 'obat.id','=','transaksi.id_obat')
    				->where('status', 'Cart')
    				->where('id_user', $id_user)
                    ->select('transaksi.*','obat.obat')
    				->get();

    	return view('cart', compact('data'));
    }


    public function hapusCart(Request $request, $id)
    {
        // jika belum login maka tidak bisa membeli
        if(!$request->session()->has('email')){
            return redirect('/login');
        }

        // jika yang login bukan pelanggan
        if($request->session()->get('role_id') != 2) {
            return redirect('/');
        }

        // id user diambil dari session id_user
        $id_user = $request->session()->get('id_user');

        // hapus cart
        Transaksi::where('id', $id)->delete();

        return redirect('/cart');
    }

    // checkout transaksi
    public function checkout(Request $request)
    {
        // jika belum login maka tidak bisa membeli
        if(!$request->session()->has('email')){
            return redirect('/login');
        }

        // jika yang login bukan pelanggan
        if($request->session()->get('role_id') != 2) {
            return redirect('/');
        }


        if (!$request->selected) {
            return redirect('/cart')->with('error','Pilih obat yang akan di Checkout!');
        } else {
            // tampung id transaksi yang akan di checkout
            $selected = $request->selected;

            
            $id_user =  $request->session()->get('id_user');

            $total = 0;
            for ($i=0; $i < count($selected) ; $i++) { 

              // ambil obat di table transaksi sesuai id transaksi
              $transaksi = Transaksi::all()->where('id',$selected[$i])->first();

              $jumlah = $transaksi->jumlah;
              $id_obat = $transaksi->id_obat;
              $total += $transaksi->total_harga;

              $invoice = time().$id_user;

              // update table transaksi menggunakan query builder
                DB::table('transaksi')
                        ->where('id', $selected[$i])
                        ->update([
                            'invoice' => $invoice,
                            'status' => 'Belum dibayar'
                        ]);

              // update stok obat menggunakan query builder
                $stok = Obat::all()->where('id', $id_obat)->first()->stok;
                DB::table('obat')
                        ->where('id', $id_obat)
                        ->update([
                            'stok' => $stok-$jumlah
                        ]);
            }

            DB::table('invoice')->insert([
                'invoice' => $invoice,
                'total' => $total,
                'tanggal' => date('YmdHis')
            ]);
            
            return redirect('/invoice/'.$invoice);
        }
    }

    public function invoice(Request $request, $invoice)
    {
        // jika belum login maka tidak bisa membeli
        if(!$request->session()->has('email')){
            return redirect('/login');
        }


        $data = DB::table('transaksi')
                        ->join('invoice', 'invoice.invoice', '=', 'transaksi.invoice')
                        ->join('obat', 'obat.id', '=', 'transaksi.id_obat')
                        ->join('users', 'users.id', '=', 'transaksi.id_user')
                        ->where('invoice.invoice', $invoice)
                        ->select('users.*','obat.*','transaksi.*', 'invoice.*')
                        ->get();


        return view('invoice', compact('data'));
    }


    public function history(Request $request)
    {
        // jika belum login maka tidak bisa membeli
        if(!$request->session()->has('email')){
            return redirect('/login');
        }

        // jika yang login bukan pelanggan
        if($request->session()->get('role_id') != 2) {
            return redirect('/');
        }

        $id_user = $request->session()->get('id_user');

        // data transaksi yang belum dibayar
        $belumBayar = DB::table('transaksi')
                                ->join('invoice','transaksi.invoice','=','invoice.invoice')
                                ->where('id_user', $id_user)
                                ->where('status', 'Belum dibayar')
                                ->distinct()->select('invoice.*')
                                ->get();

        // data transaksi yang sedang diproses
        $diproses = DB::table('transaksi')
                                ->join('invoice','transaksi.invoice','=','invoice.invoice')
                                ->where('id_user', $id_user)
                                ->where('status', 'Sedang diproses')
                                ->distinct()->select('invoice.*')
                                ->get();

        // data transaksi yang sedang dikirim
        $dikirim = DB::table('transaksi')
                                ->join('invoice','transaksi.invoice','=','invoice.invoice')
                                ->where('id_user', $id_user)
                                ->where('status', 'Dikirim')
                                ->distinct()->select('invoice.*')
                                ->get();

        // data transaksi yang sudah selesai
        $selesai = DB::table('transaksi')
                                ->join('invoice','transaksi.invoice','=','invoice.invoice')
                                ->where('id_user', $id_user)
                                ->where('status', 'Selesai')
                                ->distinct()->select('invoice.*')
                                ->get();


        // dd($belumBayar);
        return view('/history', compact('belumBayar','diproses','dikirim','selesai'));
    }

    

    public function pembayaran(Request $request, $invoice)
    {
        // jika belum login maka tidak bisa membeli
        if(!$request->session()->has('email')){
            return redirect('/login');
        }

        // jika yang login bukan pelanggan
        if($request->session()->get('role_id') != 2) {
            return redirect('/');
        }

        $id_user = $request->session()->get('role_id');

        // transaksi yang akan dibayar berdasarkan invoice
        $transaksi = DB::table('transaksi')
                        ->join('invoice', 'invoice.invoice', '=', 'transaksi.invoice')
                        ->join('obat', 'obat.id', '=', 'transaksi.id_obat')
                        ->where('invoice.invoice', $invoice)
                        ->select('obat.*','transaksi.*', 'invoice.*')
                        ->get();

        // semua invoice transaksi yang belum dibayar
        $invoices = DB::table('transaksi')
                                ->join('invoice','transaksi.invoice','=','invoice.invoice')
                                ->where('id_user', $id_user)
                                ->where('status', 'Belum dibayar')
                                ->distinct()->select('invoice.*')
                                ->get();


        return view('/pembayaran', compact('transaksi','invoices'));
    }    

    public function uploadBukti(Request $request) 
    {
        // jika belum login maka tidak bisa membeli
        if(!$request->session()->has('email')){
            return redirect('/login');
        }

        // jika yang login bukan pelanggan
        if($request->session()->get('role_id') != 2) {
            return redirect('/');
        }

        $request->validate([
            'bukti' => 'required|file|image|mimes:jpeg,png,jpg,pdf'
        ]);


        $file = $request->file('bukti');
        $nama_file = "bukti_".time()."_".$file->getClientOriginalName();

        // simpan gambar
        $file->move('assets/img/bukti/', $nama_file);


        // insert data bukti pembayaran ke tabel konfirmasi-pembayaran
        DB::table('pembayaran')->insert([
            'no_invoice' => $request->invoice,
            'bukti_pembayaran' => $nama_file
        ]);

        // ubah status menja
        DB::table('transaksi')
              ->where('invoice', $request->invoice)
              ->update([
                    'status' => 'Sedang diproses', 
                ]);
        return redirect('/pembayaran/'.$request->invoice)->with('success','Bukti pembayaran berhasil diupload.');

    }

    public function terima(Request $request)
    {
        // jika belum login maka tidak bisa membeli
        if(!$request->session()->has('email')){
            return redirect('/login');
        }

        // jika yang login bukan pelanggan
        if($request->session()->get('role_id') != 2) {
            return redirect('/');
        }

        // update status transaksi menjadi "Selesai"
        DB::table('transaksi')
                    ->where('invoice', $request->invoice)
                    ->update([
                        'status' => 'Selesai'
                    ]);

        return redirect('/history')->with('success','Pesanan '.$request->invoice.' diterima, transaksi selesai.');
    }
}
