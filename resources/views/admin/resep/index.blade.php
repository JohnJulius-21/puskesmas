@extends('admin.layouts.mainn')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 ">
        <h1 class="h2">Resep</h1>
        <div class="d-flex justify-content-end">
            <a href="{{ route('tambahResep') }}" class="btn btn-primary"><i style="width:17px" data-feather="plus"> </i>
                Tambah
                Resep</a>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Daftar Resep</h6>
        </div>
        <div class="card-body">
            <table id="pasien" class="table table-bordered display responsive nowrap" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pasien</th>
                        <th>Nama Obat</th>
                        <th>Laporan</th>
                        <th>Catatan</th>
                        <th>Nama Dokter<th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($resep as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->pasien->nama_pasien }}</td>
                            <td>{{ $item->obat->nama_obat }}</td>
                            <td>{{ $item['laporan'] }}</td>
                            <td>{{ $item['catatan'] }}</td>
                            <td>
                                @php
                                    // Cari dokter berdasarkan patient_id di tabel konsultasi
                                    $dokterNama = $konsultasi->firstWhere('patient_id', $item->patient_id)?->dokter?->name ?? 'Dokter tidak tersedia';
                                @endphp
                                {{ $dokterNama }}
                            </td>
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
