@extends('admin.layouts.mainn')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-2">
    <h1 class="h2">Konsultasi</h1>
    <div class="d-flex justify-content-end">
        <a href="{{ route('tambahPemeriksaan') }}" class="btn btn-primary btn-lg shadow-sm me-2 d-flex align-items-center">
            <span>Buat Konsultasi</span>
            <i class="fas fa-plus ms-2"></i> <!-- Added ms-2 for spacing -->
        </a>
        <a href="{{ route('riwayat_antrian') }}" class="btn custom-white-btn btn-lg shadow-sm d-flex align-items-center">
            <span>Lihat Riwayat Konsultasi</span>
            <i class="fas fa-file-alt ms-2"></i> <!-- Added ms-2 for spacing -->
        </a>
    </div>
    
</div>

{{-- Success Message Section --}}
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

{{-- CSS Styles for Status Colors --}}
<style>
       .status-dropdown {
        padding: 5px;
        border-radius: 4px;
        color: black;
        border: 1px solid #E0E0E0 ;
        background-color: #EAF7FF;
    }

    .status-dropdown.waiting {
        background-color: blue;
        color: white;
    }

    .status-dropdown.not-complete {
        background-color: red;
        color: white;
    }

    .status-dropdown.on-going {
        background-color: yellow;
        color: black;
    }

    .status-dropdown.complete {
        background-color: green;
        color: white;
    }

    .status-dropdown.default {
        background-color: gray;
        color: white;
    }

    .status-dropdown option {
        color: black; /* Text color for options */
    }
</style>

<div class="card shadow mb-2">
    <div class="card-header py-2">
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
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($konsultasi as $key => $item)
                <tr>
                    <td>{{ $item->queue }}</td>
                    <td>{{ $item->pasien->nama_pasien }}</td>
                    <td>{{ $item->dokter->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_konsultasi)->locale('id')->isoFormat('D MMMM Y H:mm') }}</td>
                    <td>{{ $item->keluhan }}</td>
                    <td>{{ $item->riwayat }}</td>
                    <td data-sort="{{ 
                        $item->status == 'waiting' ? 1 :
                        ($item->status == 'on going' ? 2 :
                        ($item->status == 'complete' ? 3 : 4)) }}">
                        <form action="{{ route('updateStatus', $item->id) }}" method="POST" class="status-form">
                            @csrf
                            @method('PATCH')
                            <select name="status" onchange="this.form.submit()" class="status-dropdown {{ str_replace(' ', '-', strtolower($item->status)) }}">
                                <option value="" disabled selected hidden>Pilih Status</option>
                                <option value="waiting" {{ $item->status == 'waiting' ? 'selected' : '' }}>Waiting</option>
                                <option value="on going" {{ $item->status == 'on going' ? 'selected' : '' }}>On Going</option>
                                <option value="complete" {{ $item->status == 'complete' ? 'selected' : '' }}>Complete</option>
                                <option value="not complete" {{ $item->status == 'not complete' ? 'selected' : '' }}>Not Complete</option>
                            </select>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-2.0.1/b-3.0.0/sl-2.0.0/datatables.min.js"></script>
<script>
    // Initialize DataTable
    $('#konsultasi').DataTable({
        scrollY: 200,
        responsive: true,
        columnDefs: [{
            targets: 6, // The status column
            orderDataType: 'dom-data-sort', // Custom sort based on data-sort attribute
        }],
        order: [[6, 'asc']] // Sort status in the following order: "waiting", "on going", "complete", and "not complete"
    });
</script>
@endsection
