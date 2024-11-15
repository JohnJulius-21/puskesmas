@extends('admin.layouts.mainn')

@section('container')
    <h1>Riwayat Antrian</h1>
    
    <!-- Menampilkan Pesan Error jika ada -->
    @if(session('error'))
        <div class="alert alert-danger" role="alert">
            <strong>Terjadi kesalahan:</strong> {{ session('error') }}
        </div>
    @endif

    <!-- Filter Instructions -->
    <div class="alert alert-info"
        style="background-color: #e7f3fe; border: 1px solid #b3d7ff; padding: 15px; font-size: 16px; line-height: 1.5;">
        <strong style="font-size: 18px; color: #00529b;"><i class="fas fa-info-circle"></i> Instruksi Filter:</strong><br>
        <span style="color: #2b6db2;">
            Gunakan filter di bawah ini untuk memfilter riwayat antrian berdasarkan <strong>tanggal</strong> dan
            <strong>status</strong>.<br>
            Anda dapat memilih <em>tanggal mulai</em> dan <em>tanggal selesai</em> untuk melihat riwayat antrian dalam
            rentang waktu tertentu.
            Selain itu, Anda juga dapat memfilter berdasarkan status konsultasi, seperti <em>Complete</em> atau <em>Not
                Complete</em>.
        </span>
    </div>

    <!-- Filter Form -->
    <form method="GET" action="{{ url()->current() }}">
        <div class="row mb-4">
            <div class="col-md-3">
                <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                <input type="date" id="tanggal_mulai" name="tanggal_mulai" class="form-control"
                    value="{{ request('tanggal_mulai') }}">
            </div>
            <div class="col-md-3">
                <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                <input type="date" id="tanggal_selesai" name="tanggal_selesai" class="form-control"
                    value="{{ request('tanggal_selesai') }}">
            </div>
            <div class="col-md-3">
                <label for="status" class="form-label">Status</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-caret-down-fill"></i>
                    </span>
                    <select id="status" name="status" class="form-control">
                        <option value="">Semua</option> <!-- This will show all statuses if no filter is applied -->
                        <option value="complete" {{ request('status') == 'complete' ? 'selected' : '' }}>Complete</option>
                        <option value="not complete" {{ request('status') == 'not complete' ? 'selected' : '' }}>Not
                            Complete</option>
                    </select>
                </div>
            </div>

            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>

    <style>
        .form-control {
            border-radius: 0.5rem;
            border: 1px solid #ced4da;
            transition: border-color 0.2s;
        }

        .form-control:focus {
            border-color: #28a745;
            box-shadow: 0 0 5px rgba(40, 167, 69, 0.5);
        }

        .btn {
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 0.5rem;
        }

        .btn:hover {
            background-color: #218838;
        }
    </style>

    @if ($riwayatAntrian->isEmpty())
        <p>Tidak ada riwayat antrian yang ditemukan.</p>
    @else
        <div class="card">

            <div class="card-header">
                <h5 class="card-title">Riwayat Antrian</h5>

                <!-- Ekspor Button -->
                <div class="col-md-4 d-flex align-items-end">
                    <form action="{{ route('export.riwayat.antrian') }}" method="GET" class="w-100">
                        <div class="row">
                            <div class="col-6">
                                <input type="date" id="tanggal_mulai_export" name="tanggal_mulai" class="form-control"
                                    placeholder="Tanggal Mulai" value="{{ request('tanggal_mulai') }}" required>
                            </div>
                            <div class="col-6">
                                <input type="date" id="tanggal_selesai_export" name="tanggal_selesai"
                                    class="form-control" placeholder="Tanggal Selesai"
                                    value="{{ request('tanggal_selesai') }}" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success btn-lg mt-2 w-100">
                            <i class="fas fa-file-export"></i> Unduh Riwayat Antrian
                        </button>
                    </form>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Pasien</th>
                            <th>Nama Dokter</th>
                            <th>Tanggal Konsultasi</th>
                            <th>Status</th>
                            {{-- <th>Catatan</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($riwayatAntrian as $antrian)
                            <tr>
                                <td>{{ $antrian->pasien->nama_pasien }}</td>
                                <td>{{ $antrian->dokter->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($antrian->tanggal_konsultasi)->locale('id')->isoFormat('D MMMM Y H:mm') }}</td>
                                <td>{{ $antrian->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection
