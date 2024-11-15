@extends('user.layouts.main')

@section('container')
    @if (session('success'))
        <div class="alert alert-success px-3 my-3 mx-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="container section-title" data-aos="fade-up">
        <h2>Konsultasi Saya</h2>
    </div>

    <div id="appointment" class="appointment section light-background" style="margin-top: 0; padding-top: 0;">
        @if ($konsultasi->isEmpty())
            <div class="card px-4 my-3 mx-3">
                <div class="card-header">
                    Konsultasi
                </div>
                <div class="card-body">
                    <p><strong>Belum ada data konsultasi!</strong></p>
                </div>
            </div>
        @else
            @if (isset($message))
                <div class="alert alert-info">
                    {{ $message }}
                </div>
            @endif

            @foreach ($konsultasi->sortBy(function ($item) {
            return \Carbon\Carbon::parse($item->tanggal_konsultasi)->format('Y-m-d H:i:s');
        }) as $item)
                <div class="card px-4 my-3 mx-3">
                    <div class="card-header">
                        Konsultasi {{ $loop->iteration }}
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Antrian: {{ $item->queue }}</h5>
                        <p class="card-text">Nama Pasien: {{ $item->pasien->nama_pasien }}</p>
                        <p class="card-text">Nama Dokter: {{ $item->dokter->name }}</p>
                        <p class="card-text">Tanggal Konsultasi:
                            {{ \Carbon\Carbon::parse($item->tanggal_konsultasi)->translatedFormat('l, d F Y') }}</p>
                        <p class="card-text">Jam Konsultasi:
                            {{ \Carbon\Carbon::parse($item->tanggal_konsultasi)->format('h:i A') }}</p>
                        <p class="card-text">
                            <strong>Status: </strong>
                            <span class="status-text {{ str_replace(' ', '-', strtolower($item->status)) }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </p>

                        <!-- Button to show resep modal -->
                        @php
                            // Find the resep for this pasien_id (from konsultasi)
                            $resepForKonsultasi = $resep->where('pasien_id', $item->pasien_id)->first();
                        @endphp

                        @if ($resepForKonsultasi)
                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#resepModal"
                                data-laporan="{{ $item->laporan }}" data-catatan="{{ $item->catatan }}"
                                data-nama-dokter="{{ $item->dokter->name }}" data-status="{{ $item->status }}"
                                data-id="{{ $resepForKonsultasi->id }}">
                                Lihat Resep
                            </a>
                        @endif

                        @if ($item->status === 'not complete')
                            <a href="{{ route('konsultasi') }}">
                                Daftar Ulang
                            </a>
                        @endif
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
                </div>
                <div class="modal-body">
                    @if ($resep->isEmpty())
                        <p><strong>Resep belum ada, mohon menunggu resep Anda!</strong></p>
                    @else
                        <p><strong>Laporan Pemeriksaan:</strong> <span id="modal-laporan"></span></p>
                        @foreach ($resep as $item)
                            <p><strong>Obat {{ $loop->iteration }}</strong></p>
                            <p><strong>Nama Obat:</strong> <span>{{ $item->obat->nama_obat }}</span></p>
                            <p><strong>Catatan:</strong> <span>{{ $item->catatan }}</span></p>
                        @endforeach
                        <p><strong>Dokter:</strong> <span id="modal-nama-dokter"></span></p>
                    @endif
                </div>
                <div class="modal-footer">
                    <!-- In HTML -->
                    <!-- In HTML (form submission) -->
                    <form action="{{ route('generate.pdf', ['id' => $konsultasi->first()->id]) }}" method="GET">
                        <button type="submit" class="btn btn-success">Cetak Resep</button>
                    </form>
                    
                    


                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- External JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            // When the modal is about to be shown
            $('#resepModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var laporan = button.data('laporan'); // Get laporan
                var catatan = button.data('catatan'); // Get catatan
                var namaDokter = button.data('nama-dokter'); // Get doctor's name
                var status = button.data('status'); // Get consultation status
                var id = button.data('id'); // Get resep id

                var modal = $(this);
                modal.find('#modal-laporan').text(laporan); // Show laporan in the modal
                modal.find('#modal-nama-dokter').text(namaDokter); // Show doctor's name in the modal

                // Set the link for the Cetak Resep button
                var cetakUrl = '{{ route('generate.pdf', ['id' => '__id__']) }}'.replace('__id__', id);
                modal.find('#cetakButton').attr('href', cetakUrl); // Set href attribute for cetak button

                // Check if the status is 'complete', then show the "Cetak" button
                if (status.trim().toLowerCase() === 'complete') {
                    modal.find('#cetakButton').removeClass('d-none'); // Show the "Cetak" button
                } else {
                    modal.find('#cetakButton').addClass('d-none'); // Hide the "Cetak" button
                }
            });
        });
    </script>
@endsection
