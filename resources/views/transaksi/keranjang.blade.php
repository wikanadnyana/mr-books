@extends('home')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    <a href="{{ route('transaksi.index') }}" class="btn btn-md btn-success mb-3">TAMBAH KERANJANG</a>
                    @if(session('error'))
                        <div class="alert alert-danger">{{session('error')}}</div>
                    @endif
                    <div class="table-responsive">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            {{-- <th scope="col">GAMBAR</th> --}}
                            <th scope="col">BUKU</th>
                            <th scope="col">QUANTITY</th>
                            <th scope="col">TOTAL HARGA</th>
                            <th scope="col">ACTION</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse ($datas as $data)
                            <tr>
                                {{-- <td class="text-center">
                                    <img src="{{ Storage::url('public/bukus/').$data->image }}" class="rounded" style="width: 100px; height : auto;">
                                </td> --}}
                                {{-- {{ dd($data->buku) }} --}}
                                <td>{{ $data->buku->judul}}</td>
                                <td>{{ $data->quantity }}</td>
                                <td>{{ $data->total_harga }}</td>
                                <td>
                                    <form action="{{ route('transaksi.batal', $data->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger">BATAL</button>
                                    </form>
                                </td>
                                
                            </tr>   
                          @empty
                              <div class="alert alert-danger">
                                  Data Buku Belum Tersedia.
                              </div>
                          @endforelse
                            <tr>
                                <td></td>
                                <td>{{ $qty }}</td>
                                <td>{{ $total }}</td>
                                <td>
                                    <form action="{{ route('transaksi.checkout') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label class="font-weight-bold">Alamat</label>
                                            <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{ old('alamat') }}" placeholder="Alamat">
                                        
                                            <!-- error message untuk title -->
                                            @error('alamat')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <input type="hidden" value="{{$qty}}" name="quantity">
                                        <input type="hidden" value="{{$total}}" name="total">
                                        <button type="submit" class="btn btn-sm btn-success">CHECKOUT</button>
                                    </form>
                                </td>
                            </tr> 
                        </tbody>
                      </table>  
                    </div>
                    
                      {{-- {{ $data->links() }} --}}
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection