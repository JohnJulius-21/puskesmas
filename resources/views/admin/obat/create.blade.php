@extends('admin.layouts.mainn')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 ">
    <h1 class="h2">Form Tambah Obat</h1>
</div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Obat</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('simpanObat') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <label for="nama" class="mb-2">Nama Obat</label>
                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" 
                           placeholder="Nama Obat" value="{{ old('nama') }}" autofocus>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
        
                <div class="col-md-12 form-group mt-3">
                    <label for="satuan" class="mb-2">Satuan</label>
                    <input type="text" class="form-control @error('satuan') is-invalid @enderror" name="satuan" id="satuan"
                           placeholder="Masukan Satuan" value="{{ old('satuan') }}">
                    @error('satuan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
        
                <div class="col-md-12 form-group mt-3">
                    <label for="stok" class="mb-2">Stok</label>
                    <input type="number" class="form-control @error('stok') is-invalid @enderror" name="stok" id="stok"
                           placeholder="Masukan Stok" value="{{ old('stok') }}">
                    @error('stok')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
        
            <div class="mt-3 text-center">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
        
    </div>
</div>

@endsection