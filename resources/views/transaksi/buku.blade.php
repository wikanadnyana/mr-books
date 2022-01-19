@extends('home')

@section('content')

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    <a href="{{ route('transaksi.index') }}" class="btn btn-md btn-danger mb-4">KEMBALI</a>
                    <form method="POST" enctype="multipart/form-data">
                    
                        @csrf


                        <div class="form-group">
                            <label class="font-weight-bold">JUDUL</label>
                            <input type="text" class="form-control" name="judul" value="{{ $buku->judul }}" readonly>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">KATEGORI</label>
                            <input type="text" class="form-control" name="kategori" value="{{ $buku->kategori->kategori}}" readonly>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">KODE</label>
                            <input type="text" class="form-control" name="kode" value="{{ $buku->kode }}" readonly>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">STOK</label>
                            <input type="text" class="form-control" name="stok" value="{{ $buku->stok }}" readonly>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">HARGA</label>
                            <input type="text" class="form-control" name="harga" value="{{ $buku->harga }}" readonly>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">SUPPLIER</label>
                            <input type="text" class="form-control" name="judul" value="{{ $buku->supplier->nama}}" readonly>
                        </div>



                    </form> 
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection