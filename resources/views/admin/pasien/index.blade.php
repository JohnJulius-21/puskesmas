@extends('admin.layouts.mainn')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 ">
        <h1 class="h2">Daftar Pasien</h1>
        <div class="d-flex justify-content-end">
            <a href="/tambah_pasien" class="btn btn-primary"><i style="width:17px" data-feather="plus"></i>
                Tambah
                Pasien</a>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Daftar Pasien</h6>
        </div>
        <div class="card-body">
            <table id="pasien" class="table table-bordered display responsive nowrap" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pasien</th>
                        <th>NIK</th>
                        <th>Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>Nomor Hp</th>
                        <th>Tanggal Konsultasi</th>
                        <th>Status</th>
                        <th>Nomor BPJS</th>
                        <th>Jenis Layanan</th>
                        <th>Nama Dokter</th>
                        <th>Keluhan</th>
                        <th>Riwayat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pasien as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item['nama_pasien'] }}</td>
                            <td>{{ $item['nik'] }}</td>
                            <td>{{ \Carbon\Carbon::parse($item['tanggal_lahir'])->locale('id')->isoFormat('D MMMM Y') }}
                            </td>
                            <td>{{ $item['jenis_kelamin'] }}</td>
                            <td>{{ $item['no_hp'] }}</td>
                            <td>{{ \Carbon\Carbon::parse($item['tanggal_konsultasi'])->locale('id')->isoFormat('D MMMM Y HH:mm A') }}</td>
                            <td>{{ $item['status'] }}</td>
                            <td>{{ $item['nomor_bpjs'] }}</td>
                            <td>{{ $item->jenis_layanan->jenis_layanan }}</td>
                            <td>{{ $item->dokter->name }}</td>
                            <td>{{ $item['keluhan'] }}</td>
                            <td>{{ $item['riwayat'] }}</td>
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
        $('#pasien').DataTable({
            scrollY: 200,
        });
    </script>
@endsection
