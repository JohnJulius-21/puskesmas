@extends('user.layouts.main')

@section('container')
    <div class="container">
        <h1>Riwayat Konsultasi</h1>
        

        @if($combinedData->isEmpty())
            <p>Anda belum memiliki riwayat konsultasi.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Dokter</th>
                        <th>Keluhan</th>
                        <th>Obat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($combinedData as $konsultasi)
                        <tr>
                            <td>{{ $konsultasi->created_at->format('d-m-Y H:i') }}</td>
                            <td>{{ $konsultasi->dokter->name }}</td>
                            <td>{{ $konsultasi->keluhan }}</td>
                            <td>
                                @if($konsultasi->resep->isNotEmpty())
                               
                                    @foreach($konsultasi->resep as $resep)
                                       
                                            {{-- Obat ID: {{ $resep->obat_id }}, --}}
                                            {{ $resep->obat->nama_obat ?? 'Nama obat tidak tersedia' }}
                                        
                                    @endforeach
                               
                            @else
                                <p>Belum ada obat yang diresepkan.</p>
                            @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

    </div>
@endsection
