@extends('adminHome')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    <a href="{{ route('supplier.create') }}" class="btn btn-md btn-success mb-3">TAMBAH SUPPLIER</a>
                    <div class="table-responsive">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">NAMA SUPPLIER</th>
                            <th scope="col">ALAMAT</th>
                            <th scope="col">NO TELP</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse ($suppliers as $supplier)
                            <tr>
                                <td>{{ $supplier->nama}}</td>
                                <td>{{ $supplier->alamat }}</td>
                                <td>{{ $supplier->no_telepon }}</td>
                                <td class="text-center">
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('supplier.destroy', $supplier->id) }}" method="POST">
                                        <a href="{{ route('supplier.edit', $supplier->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                    </form>
                                </td>
                            </tr>
                          @empty
                              <div class="alert alert-danger">
                                  Data Supplier Belum Tersedia.
                              </div>
                          @endforelse
                        </tbody>
                      </table>  
                    </div>
                    
                      {{ $suppliers->links() }}
                </div>
            </div>
        </div>
    </div>
  </div>
    
@endsection