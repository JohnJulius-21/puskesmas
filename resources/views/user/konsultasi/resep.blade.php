<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resep Konsultasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            margin: 20px;
        }
        .header, .content {
            margin-bottom: 20px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table, .table th, .table td {
            border: 1px solid black;
        }
        .table th, .table td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h1>Resep Konsultasi</h1>
        <p><strong>Tanggal:</strong> {{ $konsultasi->tanggal_konsultasi }}</p>
        <p><strong>Nama Pasien:</strong> {{ $konsultasi->pasien->nama_pasien }}</p>
        <p><strong>Nama Dokter:</strong> {{ $konsultasi->dokter->name }}</p>
        <p><strong>Antrian:</strong> {{ $konsultasi->queue }}</p>
        <p><strong>Status:</strong> {{ ucfirst($konsultasi->status) }}</p>
    </div>

    <div class="content">
        <h3>Detail Resep:</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Obat</th>
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($resep as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->obat->nama_obat }}</td>
                        <td>{{ $item->catatan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="footer">
        <p>Dokter: {{ $konsultasi->dokter->name }}</p>
        <p>Semoga lekas sembuh!</p> <!-- Pesan tambahan -->
    </div>
</div>

</body>
</html>
