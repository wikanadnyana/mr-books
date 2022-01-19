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
                            <th scope="col">NOMOR NOTA</th>
                            <th scope="col">NAMA PEMBELI</th>
                            <th scope="col">ALAMAT</th>
                            <th scope="col">TOTAL PEMBELIAN</th>
                            <th scope="col">STATUS</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse ($transaksis as $transaksi)
                            <tr>
                                <td>{{ $transaksi->nomor_nota}}</td>
                                <td>{{ Auth::user()->name }}</td>
                                <td>{{ $transaksi->alamat_pembeli }}</td>
                                <td>{{ $transaksi->total_pembelian }}</td>
                                <td>
                                    @if($transaksi->status == "pending")
                                      <a href="#" class="btn btn-primary btn-lg disabled" role="button" aria-disabled="true">{{ $transaksi->status }}</a>   
                                    @elseif($transaksi->status == "sukses")
                                      <a href="#" class="btn btn-success btn-lg disabled" role="button" aria-disabled="true">{{ $transaksi->status }}</a>   
                                    @else
                                      <a href="#" class="btn btn-danger btn-lg disabled" role="button" aria-disabled="true">{{ $transaksi->status }}</a>   
                                    @endif
                                    

                                </td>
                                <td>
                                    <a href="{{ route('transaksi.detail', $transaksi->id) }}" class="btn btn-sm btn-primary">DETAIL</a>
                                </td>

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