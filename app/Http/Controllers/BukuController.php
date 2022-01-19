<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class BukuController extends Controller
{
    public function index()
    {
        $bukus = Buku::latest()->paginate(5);
        return view('buku.index', compact('bukus'));
    }

    public function create()
    {
        $kategoriii = Kategori::all();
        $supplier = Supplier::all();
        return view('buku.create', compact('kategoriii', 'supplier'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
        'image'     => 'required|image|mimes:png,jpg,jpeg',
        'kategori_id'     => 'required',
        'supplier_id'     => 'required',
        'deskripsi'     => 'required',
        'kode'     => 'required',
        'judul'     => 'required',
        'stok'     => 'required',
        'harga'   => 'required'
        ]);

        //upload image
     $image = $request->file('image');
     $image->storeAs('public/bukus', $image->hashName());
        // dd($request->harga);
        $buku = Buku::create([
        'image'     => $image->hashName(),
        'kategori_id'     => $request->kategori_id,
        'supplier_id'     => $request->supplier_id,
        'deskripsi'     => $request->deskripsi,
        'kode'     => $request->kode,
        'judul'     => $request->judul,
        'stok'     => $request->stok,
        'harga'   => $request->harga
     ]);

     if($buku){
        //redirect dengan pesan sukses
        return redirect()->route('buku.index')->with(['success' => 'Data Berhasil Disimpan!']);
     }else{
        //redirect dengan pesan error
        return redirect()->route('buku.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function edit(Buku $buku)
    {
        $kategoriii = Kategori::all();
        $supplier = Supplier::all();
        $bukuuu = Buku::find($buku);
        return view('buku.edit', compact('buku','supplier', 'kategoriii'));
    }

    public function update(Request $request, Buku $buku)
    {
        $this->validate($request, [
            'kategori_id'     => 'required',
            'supplier_id'     => 'required',
            'deskripsi'     => 'required',
            'kode'     => 'required',
            'judul'     => 'required',
            'stok'     => 'required',
            'harga'   => 'required'
        ]);

        if($request->file('image') == "") {

            $buku->update([
                'kategori_id'     => $request->kategori_id,
                'supplier_id'     => $request->supplier_id,
                'deskripsi'     => $request->deskripsi,
                'kode'     => $request->kode,
                'judul'     => $request->judul,
                'stok'     => $request->stok,
                'harga'   => $request->harga
                
            ]);

        } else {

            //hapus old image
            Storage::disk('local')->delete('public/bukuss/'.$buku->image);

            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/bukus', $image->hashName());

            $buku->update([
                'image'     => $image->hashName(),
                'kategori_id'     => $request->kategori_id,
                'supplier_id'     => $request->supplier_id,
                'deskripsi'     => $request->deskripsi,
                'kode'     => $request->kode,
                'judul'     => $request->judul,
                'stok'     => $request->stok,
                'harga'   => $request->harga
            ]);
            
        }

        if($buku){
            //redirect dengan pesan sukses
            return redirect()->route('buku.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('buku.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);
        $buku->delete();

        if($buku){
            //redirect dengan pesan sukses
            return redirect()->route('buku.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('buku.index')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }


}

