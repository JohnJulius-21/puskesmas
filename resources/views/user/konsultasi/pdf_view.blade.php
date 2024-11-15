<!DOCTYPE html>
<html>
<head>
    <title>Resep Konsultasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: center;
        }
        .section {
            margin-bottom: 20px;
        }
        .bold {
            font-weight: bold;
        }
    </style>
</head>
<body>

    <h1>Detail Konsultasi dan Resep</h1>
    
    <div class="section">
        <p><span class="bold">Nama Pasien:</span> {{ $konsultasi->pasien->nama_pasien }}</p>
        <p><span class="bold">Nama Dokter:</span> {{ $konsultasi->dokter->name }}</p>
        <p><span class="bold">Tanggal Konsultasi:</span> {{ \Carbon\Carbon::parse($konsultasi->tanggal_konsultasi)->translatedFormat('l, d F Y') }}</p>
        <p><span class="bold">Jam Konsultasi:</span> {{ \Carbon\Carbon::parse($konsultasi->tanggal_konsultasi)->format('h:i A') }}</p>
    </div>

    <div class="section">
        <h3>Resep</h3>
        @foreach ($resep as $item)
            <p><span class="bold">Obat {{ $loop->iteration }}:</span> {{ $item->obat->nama_obat }}</p>
            <p><span class="bold">Catatan:</span> {{ $item->catatan }}</p>
        @endforeach
    </div>

    <div class="section">
        <p><span class="bold">Tanggal:</span> {{ $tanggal }}</p>
    </div>

    <div class="section">
        <p>Terimakasih, semoga cepat sembuh!</p>
    </div>

</body>
</html>
