@extends('admin.layouts.mainn')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 ">
        <h1 class="h2">Daftar Dokter</h1>
        <div class="d-flex justify-content-end">
            <a href="/tambah_dokter" class="btn btn-primary"><i style="width:17px" data-feather="plus"></i>
                Tambah
                Dokter</a>
        </div>
    </div>
    <div class="col-lg-18 mb-4">

        <!-- Project Card Example -->
        <div class="card shadow ">
            <div class="card-header py-3">
                <div class="d-flex justify-content-start">
                    <h6 class="m-0 font-weight-bold text-primary">Tabel Dokter</h6>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dokter" class="table table-bordered display responsive nowrap" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Dokter</th>
                                <th>Spesialis</th>
                                <th>No Telepon</th>
                                <th>Status</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($doctors as $doctor)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $doctor->name }}</td>
                                    <td>{{ $doctor->spesialis }}</td>
                                    <td>{{ $doctor->no_telp }}</td>
                                    <td>{{ $doctor->status }}</td>
                                    {{-- <td>
                                @if ($doctor->foto)
                                <img src="{{ asset('storage/doctor_images/'. basename($doctor->foto)) }}" alt="Doctor Image" width="50" height="50">
                                @else
                                No Image
                                @endif
                            </td> --}}

                                    <td>
                                        <form action="{{ route('delete-doctor', $doctor->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class="menu-icon tf-icons bx bx-trash" style="width:5px"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-2.0.1/b-3.0.0/sl-2.0.0/datatables.min.js"></script>
    <script>
        // Inisialisasi DataTable
        $('#dokter').DataTable({
            scrollY: 200,
        });
    </script>
@endsection
