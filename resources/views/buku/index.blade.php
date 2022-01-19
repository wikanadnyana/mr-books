@extends('adminHome')

@section('content')
<div class="container mt-5">
  <div class="row">
      <div class="col-md-12">
          <div class="card border-0 shadow rounded">
              <div class="card-body">
                  <a href="{{ route('buku.create') }}" class="btn btn-md btn-success mb-3">TAMBAH BUKU</a>
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th scope="col">GAMBAR</th>
                          <th scope="col">KATEGORI</th>
                          <th scope="col">SUPPLIER</th>
                          <th scope="col">DESKRIPSI</th>
                          <th scope="col">KODE</th>
                          <th scope="col">JUDUL</th>
                          <th scope="col">STOK</th>
                          <th scope="col">HARGA</th>
                          <th scope="col">AKSI</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse ($bukus as $buku)
                          <tr>
                              <td class="text-center">
                                  <img src="{{ Storage::url('public/bukus/').$buku->image }}" class="rounded" style="width: 100px; height : auto;">
                              </td>
                              <td>{{ $buku->kategori->kategori}}</td>
                              <td>{{ $buku->supplier->nama}}</td>
                              <td>{{ $buku->deskripsi }}</td>
                              <td>{{ $buku->kode }}</td>
                              <td>{{ $buku->judul }}</td>
                              <td>{{ $buku->stok }}</td>
                              <td>{{ $buku->harga }}</td>
                              <td class="text-center">
                                  <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('buku.destroy', $buku->id) }}" method="POST">
                                      <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                  </form>
                              </td>
                          </tr>
                        @empty
                            <div class="alert alert-danger">
                                Data Buku Belum Tersedia.
                            </div>
                        @endforelse
                      </tbody>
                    </table>  
                  </div>
                  
                    {{ $bukus->links() }}
              </div>
          </div>
      </div>
  </div>
</div>
@endsection