@extends('adminHome')
@section('content')
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    <form action="{{ route('buku.update', $buku->id) }}" method="POST" enctype="multipart/form-data">
                    
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label class="font-weight-bold">GAMBAR</label>
                            <input type="file" class="form-control" name="image">
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">KATEGORI</label>
                            <select name="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror">
                                <option value="">- Pilih -</option>
                                @foreach ($kategoriii as $item)
                                    <option value="{{ $item->id }}">{{ $item->kategori }}</option>
                                @endforeach
                            </select>
                            <!-- error message untuk title -->
                            @error('title')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label class="font-weight-bold">KODE</label>
                            <input type="text" class="form-control @error('kode') is-invalid @enderror" name="kode" value="{{ old('kode', $buku->kode) }}" placeholder="Masukkan Kode Buku">
                        
                            <!-- error message untuk title -->
                            @error('title')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">JUDUL</label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" value="{{ old('judul', $buku->judul) }}" placeholder="Masukkan Judul Buku">
                        
                            <!-- error message untuk title -->
                            @error('title')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">STOK</label>
                            <input type="text" class="form-control @error('stok') is-invalid @enderror" name="stok" value="{{ old('stok',$buku->stok) }}" placeholder="Masukkan Stok Buku">
                        
                            <!-- error message untuk title -->
                            @error('title')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">SUPPLIER</label>
                            <select name="supplier" class="form-control @error('supplier') is-invalid @enderror">
                                <option value="">- Pilih -</option>
                                @foreach ($supplier as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                            <!-- error message untuk title -->
                            @error('title')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">HARGA</label>
                            <input type="text" class="form-control @error('harga') is-invalid @enderror" name="harga" value="{{ old('harga',$buku->harga) }}" placeholder="Masukkan Harga Buku">
                        
                            <!-- error message untuk title -->
                            @error('title')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>



                        <button type="submit" class="btn btn-md btn-primary">UPDATE</button>
                        <button type="reset" class="btn btn-md btn-warning">RESET</button>

                    </form> 
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection