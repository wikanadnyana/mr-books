@extends('adminHome')

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
                          @forelse ($transaksiAdmin as $transaksi)
                            <tr>
                                <td>{{ $transaksi->nomor_nota}}</td>
                                <td>{{ Auth::user()->name }}</td>
                                <td>{{ $transaksi->alamat_pembeli }}</td>
                                <td>{{ $transaksi->total_pembelian }}</td>
                                <td>
                                    <form action="{{ route('transaksi.status', $transaksi->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <select name="status" class="form-control @error('status') is-invalid @enderror">
                                                <option value="">- Pilih -</option>
                                                <option value="pending" @if($transaksi->status == "pending") selected @endif>Pending</option>
                                                <option value="sukses" @if($transaksi->status == "sukses") selected @endif>Sukses</option>
                                                <option value="gagal" @if($transaksi->status == "gagal") selected @endif>Gagal</option>
                                                {{-- <option value="{{ $item->id }}">{{ $item->nama }}</option> --}}
                                            </select>
                                            <!-- error message untuk title -->
                                            @error('status')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <button type="submit" class="btn btn-sm btn-primary">SIMPAN</button>

                                    </form>
                                    

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