@extends('admin.layouts.mainn')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 ">
        <h1 class="h2">Konsultasi</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Buat Konsultasi</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('simpanPemeriksaan') }}" method="POST">
                @csrf
                <div class="col-md-12 form-group mt-3">
                    <label for="pasien" class="mb-2">Pilih Pasien</label>
                    <select name="pasien" id="pasien" class="form-select @error('pasien') is-invalid @enderror">
                        <option value="">Pilih Pasien</option>
                        @foreach ($pasien as $item)
                            @php
                                // Check if the patient has any ongoing or waiting consultations
                                $hasOngoingConsultation = $item->konsultasi->whereIn('status', ['waiting', 'on going'])->isNotEmpty();
                            @endphp
                            <option value="{{ $item['id'] }}" data-status="{{ $hasOngoingConsultation ? 'in_process' : 'available' }}">
                                {{ $item['nama_pasien'] }}
                            </option>
                        @endforeach
                    </select>
                    @error('pasien')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Informasi Pasien -->
                <div class="mt-3">
                    <h5>Informasi Pasien</h5>
                    <div class="mb-3">
                        <label for="patient-name">Nama:</label>
                        <input type="text" class="form-control" id="patient-name" name="nama_pasien" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="patient-nik">NIK:</label>
                        <input type="text" class="form-control" id="patient-nik" name="nik" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="patient-birthdate">Tanggal Lahir:</label>
                        <input type="date" class="form-control" id="patient-birthdate" name="tanggal_lahir" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="patient-gender">Jenis Kelamin:</label>
                        <input type="text" class="form-control" id="patient-gender" name="jenis_kelamin" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="patient-datekonsul">Tanggal Konsultasi:</label>
                        <input type="datetime-local" class="form-control" id="patient-datekonsul" name="tanggal_konsultasi" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="patient-keluhan">Keluhan Pasien:</label>
                        <input type="text" class="form-control" id="patient-keluhan" name="keluhan" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="patient-riwayat">Riwayat Pasien:</label>
                        <input type="text" class="form-control" id="patient-riwayat" name="riwayat" readonly>
                    </div>
                </div>

                <!-- Pilih Dokter -->
                <div class="col-md-12 form-group mt-3">
                    <label for="dokter" class="mb-2">Pilih Dokter</label>
                    <select name="dokter" id="dokter" class="form-select @error('dokter') is-invalid @enderror">
                        <option value="">Pilih Dokter</option>
                        @foreach ($dokter as $item)
                            <option value="{{ $item->id }}" {{ old('dokter') == $item->id ? 'selected' : '' }}>
                                {{ $item->name }} - {{ $item->spesialis }}
                            </option>
                        @endforeach
                    </select>
                    @error('dokter')
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
            var selectedOption = $(this).find('option:selected');
            var patientStatus = selectedOption.data('status'); // Get the selected patient's status

            if (patientStatus === 'in_process') {
                alert("Pasien sedang dalam proses");
                $(this).val(''); // Reset selection if needed
            } else {
                var patientId = selectedOption.val();

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
                        } else {
                            alert("Data pasien tidak ditemukan.");
                        }
                    }
                });
            }
        });
    </script>
@endsection
