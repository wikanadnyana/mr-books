<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::latest()->paginate(5);
        return view('supplier.index', compact('suppliers'));
    }
    
    public function create()
    {
        return view('supplier.create');

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama'     => 'required',
            'alamat'     => 'required',
            'no_telepon'     => 'required'
        ]);
    
    
        $supplier = Supplier::create([
            'nama'     => $request->nama,
            'alamat'     => $request->alamat,
            'no_telepon'     => $request->no_telepon
        ]);
    
        if($supplier){
            //redirect dengan pesan sukses
            return redirect()->route('supplier.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('supplier.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function edit(Supplier $supplier)
    {
        $supplierrr = Supplier::find($supplier);
        return view('supplier.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {

        $request->validate([
            'nama'     => 'required',
            'alamat'     => 'required',
            'no_telepon'     => 'required'
        ]);

        $supplier->update([
            'nama'     => $request->nama,
            'alamat'     => $request->alamat,
            'no_telepon'     => $request->no_telepon
        ]);

        return redirect()->route('supplier.index')->with(['success' => 'Data Berhasil Diperbarui!']); 
    }

    public function destroy($id)
    {
        $supplierr = Supplier::find($id);
        $supplierr->delete();
        return redirect()->route('supplier.index')->with(['success' => 'Data Berhasil Dihapus!']); 

    }
}
