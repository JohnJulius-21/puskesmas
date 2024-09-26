@extends('admin.layouts.mainn')

@section('container')
    @if (session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <h1 class="h2">Daftar Obat</h1>
        <div class="d-flex justify-content-end">
            <a href="{{ route('tambahObat') }}" class="btn btn-primary"><i style="width:17px" data-feather="plus"></i>
                Tambah Obat</a>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Obat</h6>
        </div>
        <div class="card-body">
            <table id="obat" class="table table-bordered display responsive nowrap" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Obat</th>
                        <th>Satuan</th>
                        <th>Stok</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($obat as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item['nama_obat'] }}</td>
                            <td>{{ $item['satuan_terkecil'] }}</td>
                            <td>{{ $item['status'] }}</td>
                            <td>
                                <div class="row g-0">
                                    <div class="col-5 d-flex justify-content-start p-0">
                                        <a href="#editModal{{ $item['id'] }}" rel="modal:open"
                                            class="btn btn-warning me-2">Edit</a>
                                        <form action="{{ route('hapusObat', $item['id']) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal untuk Edit Data Obat -->
                        <div id="editModal{{ $item['id'] }}" class="modal mt-3" style="height: auto; width:600px">
                            <h2>Edit Obat</h2>
                            <form action="{{ route('updateObat', $item['id']) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Obat</label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        value="{{ $item['nama_obat'] }}">
                                </div>
                                <div class="mb-3">
                                    <label for="satuan" class="form-label">Satuan Terkecil</label>
                                    <input type="text" class="form-control" id="satuan" name="satuan"
                                        value="{{ $item['satuan_terkecil'] }}">
                                </div>
                                <div class="mb-3">
                                    <label for="stok" class="form-label">Stok</label>
                                    <input type="number" class="form-control" id="stok" name="stok"
                                        value="{{ $item['status'] }}">
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />

    <script src="https://cdn.datatables.net/v/bs5/dt-2.0.1/b-3.0.0/sl-2.0.0/datatables.min.js"></script>
    <script>
        // Inisialisasi DataTable
        $('#obat').DataTable({
            scrollY: 200,
        });
    </script>
@endsection
