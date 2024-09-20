@extends('user.layouts.main')

@section('container')
    @if (session('success'))
        <div class="alert alert-success px-3 my-3 mx-3">
            {{ session('success') }}
        </div>
    @endif

    <div id="appointment" class="appointment section light-background">
        <div class="container section-title mt-3" data-aos="fade-up">
            <h2>Konsultasi Saya</h2>
        </div>
        @if ($konsultasi->isEmpty())
            <div class="card px-4 my-5 mx-5">
                <div class="card-header">
                    Konsultasi
                </div>
                <div class="card-body">
                    <p><strong>Belum ada data konsultasi!</strong></p>
                </div>
            </div>
        @else
            @foreach ($konsultasi as $item)
                <div class="card px-4 my-5 mx-5">
                    <div class="card-header">
                        Konsultasi
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Antrian : {{ $item['queue'] }}</h5>
                        <p class="card-text">Nama Pasien : {{ $item->pasien->nama_pasien }}</p>
                        <p class="card-text">Nama Dokter : {{ $item->dokter->name }}</p>
                        <p class="card-text">Tanggal Konsultasi :
                            {{ \Carbon\Carbon::parse($item->tanggal_konsultasi)->translatedFormat('l, d F Y') }}</p>
                        <p class="card-text">Jam : {{ \Carbon\Carbon::parse($item->tanggal_konsultasi)->format('h:i A') }}
                        </p>
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#resepModal"
                            data-laporan="{{ $item->laporan }}" data-catatan="{{ $item->catatan }}">
                            Lihat Resep
                        </a>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <!-- Resep Modal -->
    <div class="modal fade" id="resepModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Resep</h5>
                    {{-- <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button> --}}
                </div>
                <div class="modal-body">
                    @if ($resep->isEmpty())
                        <p><strong>Resep belum ada, mohon menunggu resep Anda!</strong></p>
                    @else
                        @foreach ($resep as $item)
                            <p><strong>Nama Obat:</strong> <span>{{ $item->obat->nama_obat }}</span></p>
                            <p><strong>Catatan:</strong> <span>{{ $item->catatan }}</span></p>
                            <p><strong>Laporan Pemeriksaan:</strong> <span>{{ $item->laporan }}</span></p>
                        @endforeach
                    @endif
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



    <!-- Tambahkan jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Tambahkan Bootstrap JS (ini adalah bagian penting untuk modal) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <script>
        $('#resepModal').on('show.bs.modal', function(event) {});
    </script>
@endsection
