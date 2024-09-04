@extends('admin.layouts.mainn')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Form Tambah Dokter</h1>
    </div>
    <div class="col-lg-18 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Dokter</h6>
            </div>
            <div class="card-body">
                <form id="addDoctorForm" action="{{ route('add.doctor') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="name">Nama:</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                
                    <div class="form-group mb-3">
                        <label for="spesialis">Spesialis:</label>
                        <select name="spesialis" class="form-control @error('spesialis') is-invalid @enderror">
                            <option value="">Pilih Spesialis</option>
                            <option value="Umum" {{ old('spesialis') == 'Umum' ? 'selected' : '' }}>Umum</option>
                            <option value="Gigi dan Mulut" {{ old('spesialis') == 'Gigi dan Mulut' ? 'selected' : '' }}>Gigi dan Mulut</option>
                            <option value="Kehamilan dan Anak" {{ old('spesialis') == 'Kehamilan dan Anak' ? 'selected' : '' }}>Kehamilan dan Anak</option>
                            <option value="Gigi" {{ old('spesialis') == 'Gigi' ? 'selected' : '' }}>Gigi</option>
                            <option value="Lab" {{ old('spesialis') == 'Lab' ? 'selected' : '' }}>Lab</option>
                            <option value="Gizi" {{ old('spesialis') == 'Gizi' ? 'selected' : '' }}>Gizi</option>
                            <option value="Psikologi" {{ old('spesialis') == 'Psikologi' ? 'selected' : '' }}>Psikologi</option>
                            <option value="Radiologi" {{ old('spesialis') == 'Radiologi' ? 'selected' : '' }}>Radiologi</option>
                            <option value="Fisioterapi" {{ old('spesialis') == 'Fisioterapi' ? 'selected' : '' }}>Fisioterapi</option>
                            <option value="Apoteker" {{ old('spesialis') == 'Apoteker' ? 'selected' : '' }}>Apoteker</option>
                        </select>
                        @error('spesialis')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                
                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                            <option value="">Pilih Status</option>
                            <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Tidak Aktif" {{ old('status') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                
                    <div class="form-group mt-3">
                        <label for="no_telp">Nomor Telepon:</label>
                        <input type="tel" class="form-control @error('no_telp') is-invalid @enderror" id="no_telp" name="no_telp" value="{{ old('no_telp') }}">
                        @error('no_telp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                
                    <div class="form-group mb-3 mt-3">
                        <label for="foto">Foto:</label>
                        <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" name="foto" accept=".jpg, .jpeg, .png" value="{{ old('foto') }}">
                        @error('foto')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                
                    <button type="submit" class="btn btn-primary">Tambah Dokter</button>
                </form>
                
            </div>
        </div>
    </div>
@endsection
