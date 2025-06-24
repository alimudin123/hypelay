<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Penjualan</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }

        th {
            background-color: #eee;
        }
    </style>
</head>

<body>
    <h2 style="text-align: center;">Laporan Penjualan</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Transaksi</th>
                <th>Nama Pembeli</th>
                <th>Resi</th>
                <th>Total</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporan as $i => $trx)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $trx->kode_transaksi }}</td>
                <td>{{ $trx->user->name ?? '-' }}</td>
                <td>{{ $trx->resi ?? '-' }}</td>
                <td>Rp{{ number_format($trx->total, 0, ',', '.') }}</td>
                <td>{{ ucfirst($trx->status) }}</td>
                <td>{{ $trx->created_at->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>