@extends('admin.layouts.mainn')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 ">
        <h1 class="h2">Tambah Resep</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Buat Resep</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('simpanResep') }}" method="POST">
                @csrf
                <div class="col-md-12 form-group mt-3">
                    <label for="pasien" class="mb-2">Pilih Pasien</label>
                    <select name="pasien" id="pasien" class="form-select @error('pasien') is-invalid @enderror">
                        <option value="">Pilih Pasien</option>
                        @foreach ($konsultasi as $item)
                            <option value="{{ $item->pasien->id }}"
                                {{ old('pasien') == $item->pasien->id ? 'selected' : '' }}>
                                {{ $item->queue }} - {{ $item->pasien->nama_pasien }}, Dokter: {{ $item->dokter->name }},
                                Tangggal Konsultasi :
                                {{ \Carbon\Carbon::parse($item->tanggal_konsultasi)->translatedFormat('l, d F Y') }}
                            </option>
                        @endforeach
                    </select>
                    @error('pasien')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12 form-group mt-3">
                    <label for="laporan" class="mb-2">Laporan Pemeriksaan</label>
                    {{-- <input type="text" class="form-control"> --}}
                    <textarea name="laporan" id="" cols="30" rows="10" class="form-control"></textarea>
                    @error('laporan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Pilih Obat -->
                <div class="col-md-12 form-group mt-3">
                    <label for="obat" class="mb-2">Pilih Obat</label>
                    <select name="obat" id="obat" class="form-select @error('obat') is-invalid @enderror">
                        <option value="">Pilih Obat</option>
                        @foreach ($obat as $item)
                            <option value="{{ $item->id }}" {{ old('obat') == $item->id ? 'selected' : '' }}>
                                {{ $item->nama_obat }}
                            </option>
                        @endforeach
                    </select>
                    @error('dokter')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12 form-group mt-3">
                    <label for="catatan" class="mb-2">Catatan</label>
                    {{-- <input type="number" class="form-control" > --}}
                    <textarea name="catatan" id="" cols="30" rows="10" class="form-control"></textarea>
                    @error('catatan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="mt-3">
                    <div class="text-center"><button type="submit" class="btn btn-primary">Simpan</button></div>
                </div>
            </form>
        </div>
    </div>

    <!-- jQuery and AJAX -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#pasien').on('change', function() {
            var patientId = $(this).val();

            if (patientId) {
                $.ajax({
                    url: '/get-patient-info/' + patientId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        if (data) {
                            $('#patient-name').val(data.nama_pasien);
                            $('#patient-nik').val(data.nik);
                            $('#patient-birthdate').val(data.tanggal_lahir);
                            $('#patient-datekonsul').val(data.tanggal_konsultasi);
                            $('#patient-gender').val(data.jenis_kelamin);
                            $('#patient-keluhan').val(data.keluhan);
                            $('#patient-riwayat').val(data.riwayat);
                            // Tambahkan pengisian data field lain jika ada
                        } else {
                            alert("Data pasien tidak ditemukan.");
                        }
                    }
                });
            } else {
                // Kosongkan field jika pasien tidak dipilih
                $('#patient-name').val('');
                $('#patient-nik').val('');
                $('#patient-birthdate').val('');
                $('#patient-datekonsul').val('');
                $('#patient-gender').val('');
                $('#patient-keluhan').val('');
                $('#patient-riwayat').val('');
            }
        });
    </script>
@endsection
