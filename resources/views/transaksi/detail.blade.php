@extends('home')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">JUDUL</th>
                            <th scope="col">QUANTITY</th>
                            <th scope="col">TOTAL HARGA</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse ($transaksis as $transaksi)
                            <tr>
                                <td>{{ $transaksi->buku->judul }}</td>
                                <td>{{ $transaksi->quantity }}</td>
                                <td>{{ $transaksi->total_harga }}</td>

                                {{-- <td class="text-center">
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('buku.destroy', $buku->id) }}" method="POST">
                                        <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                    </form>
                                </td> --}}
                            </tr>
                          @empty
                              <div class="alert alert-danger">
                                  Data Buku Belum Tersedia.
                              </div>
                          @endforelse
                          <tr>
                            <td></td>
                            <td>{{$qty}}</td>
                            <td>{{$total}}</td>
                          </tr>
                        </tbody>
                      </table>  
                    </div>
                    
                      {{-- {{ $transaksis->links() }} --}}
                </div>
            </div>
        </div>
    </div>
  </div>

@endsection