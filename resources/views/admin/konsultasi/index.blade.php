@extends('admin.layouts.mainn')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 ">
        <h1 class="h2">Konsultasi</h1>
        <div class="d-flex justify-content-end">
            <a href="/tambah_pemeriksaan" class="btn btn-primary"><i style="width:17px" data-feather="plus"></i>
                Buat Konsultasi</a>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Daftar Konsultasi</h6>
        </div>
        <div class="card-body">
            <table id="konsultasi" class="table table-bordered display responsive nowrap" width="100%">
                <thead>
                    <tr>
                        <th>Antrian</th>
                        <th>Nama Pasien</th>
                        <th>Dokter</th>
                        <th>Tanggal Konsultasi</th>
                        <th>Keluhan</th>
                        <th>Riwayat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($konsultasi as $key => $item)
                        <tr>
                            <td>{{ $item->queue }}</td>
                            <td>{{ $item->pasien->nama_pasien }}</td>
                            <td>{{ $item->dokter->name}}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_konsultasi)->locale('id')->isoFormat('D MMMM Y H:mm') }}</td>
                            <td>{{ $item->keluhan }}</td>
                            <td>{{ $item->riwayat }}</td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-2.0.1/b-3.0.0/sl-2.0.0/datatables.min.js"></script>
    <script>
        // Inisialisasi DataTable
        $('#konsultasi').DataTable({
            scrollY: 200,
            responsive: true
        });
    </script>
@endsection
