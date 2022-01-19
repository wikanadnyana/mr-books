<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\DetailTransaksiTemp;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;

class TransaksiController extends Controller
{
    public function index(){
        $bukus = Buku::latest()->paginate(5);

        return view('transaksi.index', compact('bukus'));
    }

    public function create(Request $request, $id){
        // dd($id);
        $data = Buku::find($id);

        if($data->stok < $request->quantity){
            //redirect dengan pesan sukses
            return redirect()->route('transaksi.index')->with(['error' => 'Stok Tidak Mencukupi']);
            
        }else{
            // dd(Auth::id());

            DetailTransaksiTemp::create([
                'buku_id' => $data->id,
                'user_id' => Auth::id(),
                'quantity' => $request->quantity,
                'total_harga' => $request->quantity * $data->harga
            ]);
            $updateStok = $data->stok - $request->quantity;

            $data->update([
                'stok' => $updateStok
            ]);


            return redirect()->route('transaksi.keranjang')->with(['success' => 'Buku berhasil disimpan di keranjang!']);

        }
    }

    public function indexKeranjang(){
        $datas = DetailTransaksiTemp::where('user_id','=', Auth::id())->get();

        $totalQuantity = array();
        $totalPembelian = array();

        foreach($datas as $data){
            array_push($totalQuantity, $data->quantity);
            array_push($totalPembelian, $data->total_harga);
        }
        $qty = array_sum($totalQuantity);
        $total = array_sum($totalPembelian);
        return view('transaksi.keranjang', compact('datas','qty','total'));
    }

    public function batalKeranjang($id){
        $data = DetailTransaksiTemp::find($id);
        $buku = Buku::find($data->buku_id);
        $buku->update([
            'stok' => $buku->stok + $data->quantity
        ]);
        $data->delete();

        return redirect()->route('transaksi.keranjang')->with(['success' => 'Buku dihapus dari keranjang!']);

    }

    public function checkoutKeranjang(Request $request){
        $getRow = Transaksi::orderBy('id', 'DESC')->get();
        $rowCount = $getRow->count();
        
        $lastId = $getRow->first();

        $kode = "TR00001";
        
        if ($rowCount > 0) {
            if ($lastId->id < 9) {
                    $kode = "TR0000".''.($lastId->id + 1);
            } else if ($lastId->id < 99) {
                    $kode = "TR000".''.($lastId->id + 1);
            } else if ($lastId->id < 999) {
                    $kode = "TR00".''.($lastId->id + 1);
            } else if ($lastId->id < 9999) {
                    $kode = "TR0".''.($lastId->id + 1);
            } else {
                    $kode = "TR".''.($lastId->id + 1);
            }
        }

        Transaksi::create([
            'nomor_nota' => $kode,
            'user_id' => Auth::id(),
            'alamat_pembeli' => $request->alamat,
            'total_pembelian' => $request->total
        ]);

        $temps = DetailTransaksiTemp::where('user_id','=',Auth::id())->get();

        $transId = Transaksi::latest()->first();
        // dd($transId);

        foreach($temps as $temp){
            DetailTransaksi::create([
                'transaksi_id' => $transId->id,
                'buku_id' => $temp->buku_id,
                'quantity' => $temp->quantity,
                'total_harga' => $temp->total_harga,
            ]);
        }
        DetailTransaksiTemp::where('user_id','=', Auth::id())->delete();

        return redirect()->route('transaksi.riwayat')->with(['success' => 'Transaksi telah di proses!']);

    }

    public function riwayatTransaksi(){
        $transaksis = Transaksi::where('user_id','=', Auth::id())->orderBy('id', 'desc')->get();
        $transaksiAdmin = Transaksi::orderBy('id', 'desc')->get();
        if(Auth::user()->is_admin == 1){
            return view('transaksi.riwayatAdmin', compact('transaksiAdmin'));
        }else{
            return view('transaksi.riwayat', compact('transaksis'));
        }

    }

    public function detailBuku($id)
    {
        $buku = Buku::find($id);
        return view('transaksi.buku', compact('buku'));
    }

    public function detailTransaksi($id){
        $transaksis = DetailTransaksi::where('transaksi_id','=', $id)->get();

        $datas = DetailTransaksi::where('transaksi_id','=', $id)->get();

        $totalQuantity = array();
        $totalPembelian = array();

        foreach($datas as $data){
            array_push($totalQuantity, $data->quantity);
            array_push($totalPembelian, $data->total_harga);
        }
        $qty = array_sum($totalQuantity);
        $total = array_sum($totalPembelian);

        if(Auth::user()->is_admin == 1){
            return view('transaksi.detailAdmin', compact('transaksis','qty','total'));
        }else{
            return view('transaksi.detail', compact('transaksis','qty','total'));
            
        }
    }

    public function ubahStatus(Request $request,$id){
        $transaksis = Transaksi::where('id','=', $id)->get()->first();

        
        // dd($transaksis);

        $transaksis->update([
            'status' => $request->status
        ]);
        $detTrans = DetailTransaksi::where('transaksi_id','=',$transaksis->id)->get();
        // dd($detTrans->quantity);
        if($request->status == "gagal"){
            foreach($detTrans as $det){
                $buku = Buku::where('id','=',$det->buku_id)->get()->first();
                $buku->update([
                    'stok'=> $buku->stok + $det->quantity
                ]);
            }
        }
        return redirect()->route('transaksi.riwayat')->with(['success' => 'Status transaksi telah diubah!']);

    }
}
