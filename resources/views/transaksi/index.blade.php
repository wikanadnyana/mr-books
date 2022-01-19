@extends('home')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow rounded">
                <div class="card-body">
                   
                    @if(session('error'))
                        <div class="alert alert-danger">{{session('error')}}</div>
                    @endif
                    <div class="table-responsive">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">GAMBAR</th>
                            <th scope="col">KATEGORI</th>
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
                                {{-- <td>{{ $buku->supplier->nama}}</td> --}}
                                {{-- <td>{{ \Illuminate\Support\Str::limit($buku->deskripsi, 50, $end='...') }}</td> --}}
                                {{-- <td>{{ $buku->kode }}</td> --}}
                                <td>{{ $buku->judul }}</td>
                                <td>{{ $buku->stok }}</td>
                                <td>{{ $buku->harga }}</td>
                                <td class="text-center">
                                    <form action="{{ route('transaksi.create', $buku->id) }}" method="POST">
                                        @csrf
                                        
                                        <div class="form-group">
                                            <label class="font-weight-bold">Quantity</label>
                                            <input type="text" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity') }}" placeholder="Jumlah Barang">
                                        
                                            <!-- error message untuk title -->
                                            @error('quantity')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <button type="submit" class="btn btn-sm btn-danger">BELI</button>
                                        <a href="{{ route('transaksi.bukudetail', $buku->id) }}" class="btn btn-sm btn-primary">DETAIL</a>
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