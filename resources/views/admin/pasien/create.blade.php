@extends('admin.layouts.mainn')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 ">
        <h1 class="h2">Form Tambah Pasien</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pasien</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('pasienStore') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <label for="nama" class="mb-2">Nama Pasien</label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" 
                               placeholder="Nama Pasien" value="{{ old('nama') }}" autofocus>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <div class="col-md-12 form-group mt-3">
                        <label for="nik" class="mb-2">NIK</label>
                        <input type="text" class="form-control @error('nik') is-invalid @enderror" name="nik" id="nik"
                               placeholder="Masukan NIK Anda" value="{{ old('nik') }}">
                        @error('nik')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <div class="col-md-12 form-group mt-3">
                        <label for="jenis_kelamin" class="mb-2">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki - Laki" {{ old('jenis_kelamin') == 'Laki - Laki' ? 'selected' : '' }}>Laki - Laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <div class="col-md-12 form-group mt-3">
                        <label for="tanggal_lahir" class="mb-2">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir"
                               value="{{ old('tanggal_lahir') }}">
                        @error('tanggal_lahir')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <div class="col-md-12 form-group mt-3">
                        <label for="alamat" class="mb-2">Alamat</label>
                        <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat"
                               placeholder="Masukan Alamat Anda" value="{{ old('alamat') }}">
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <div class="col-md-12 form-group mt-3">
                        <label for="no_hp" class="mb-2">Nomor Telepon</label>
                        <input type="text" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" id="no_hp"
                               placeholder="Masukan Nomor Telepon Anda" value="{{ old('no_hp') }}">
                        @error('no_hp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <div class="col-md-12 form-group mt-3">
                        <label for="status" class="mb-2">Status</label>
                        <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                            <option value="">Pilih Status</option>
                            <option value="UMUM" {{ old('status') == 'UMUM' ? 'selected' : '' }}>UMUM</option>
                            <option value="BPJS" {{ old('status') == 'BPJS' ? 'selected' : '' }}>BPJS</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <div class="col-md-12 form-group mt-3" id="bpjs-field" style="display: {{ old('status') == 'BPJS' ? 'block' : 'none' }};">
                        <label for="nomor_bpjs" class="mb-2">Nomor BPJS</label>
                        <input type="text" name="nomor_bpjs" id="nomor_bpjs" class="form-control @error('nomor_bpjs') is-invalid @enderror"
                               placeholder="Masukkan Nomor BPJS" value="{{ old('nomor_bpjs') }}">
                        @error('nomor_bpjs')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <div class="col-md-12 form-group mt-3">
                        <label for="tanggal_konsultasi" class="mb-2">Tanggal Konsultasi</label>
                        <input type="datetime-local" name="tanggal_konsultasi" class="form-control @error('tanggal_konsultasi') is-invalid @enderror"
                               id="tanggal_konsultasi" value="{{ old('tanggal_konsultasi') }}">
                        @error('tanggal_konsultasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <div class="col-md-12 form-group mt-3">
                        <label for="jenis_layanan" class="mb-2">Pilih Jenis Layanan</label>
                        <select name="jenis_layanan" id="jenis_layanan" class="form-select @error('jenis_layanan') is-invalid @enderror">
                            <option value="">Pilih Jenis Layanan</option>
                            @foreach ($layanan as $item)
                                <option value="{{ $item['id'] }}" {{ old('jenis_layanan') == $item['id'] ? 'selected' : '' }}>
                                    {{ $item['jenis_layanan'] }}
                                </option>
                            @endforeach
                        </select>
                        @error('jenis_layanan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <div class="col-md-12 form-group mt-3">
                        <label for="dokter" class="mb-2">Pilih Dokter</label>
                        <select name="dokter" id="dokter" class="form-select @error('dokter') is-invalid @enderror">
                            <option value="">Pilih Dokter</option>
                            @foreach ($dokter as $item)
                                <option value="{{ $item['id'] }}" {{ old('dokter') == $item['id'] ? 'selected' : '' }}>
                                    {{ $item['name'] }} - {{ $item['spesialis'] }}
                                </option>
                            @endforeach
                        </select>
                        @error('dokter')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            
                <div class="form-group mt-3">
                    <label for="keluhan" class="mb-2">Keluhan Pasien</label>
                    <textarea class="form-control @error('keluhan') is-invalid @enderror" name="keluhan" rows="5" 
                              placeholder="Masukan Keluhan Anda">{{ old('keluhan') }}</textarea>
                    @error('keluhan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            
                <div class="form-group mt-3">
                    <label for="riwayat" class="mb-2">Riwayat Penyakit</label>
                    <textarea class="form-control @error('riwayat') is-invalid @enderror" name="riwayat" rows="5"
                              placeholder="Masukan Riwayat Anda">{{ old('riwayat') }}</textarea>
                    @error('riwayat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            
                <div class="mt-3 text-center">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
            
        </div>
    </div>

    <script>
        document.getElementById('status').addEventListener('change', function() {
            var bpjsField = document.getElementById('bpjs-field');
            if (this.value == '2') {
                bpjsField.style.display = 'block';
            } else {
                bpjsField.style.display = 'none';
            }
        });
    </script>

    
@endsection
