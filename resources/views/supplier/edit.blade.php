@extends('adminHome')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    <div class="table-responsive">
                        <form action="{{ route('supplier.update', $supplier->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label class="font-weight-bold">NAMA SUPPLIER</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ $supplier->nama }}">
                            
                                <!-- error message untuk title -->
                                @error('nama')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
    
                            <div class="form-group">
                                <label class="font-weight-bold">ALAMAT</label>
                                <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{ $supplier->alamat }}" >
                            
                                <!-- error message untuk title -->
                                @error('alamat')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
    
                            <div class="form-group">
                                <label class="font-weight-bold">NO TELEPON</label>
                                <input type="text" class="form-control @error('no_telepon') is-invalid @enderror" name="no_telepon" value="{{ $supplier->no_telepon }}" >
                            
                                <!-- error message untuk title -->
                                @error('no_telepon')
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
  </div>
    
@endsection