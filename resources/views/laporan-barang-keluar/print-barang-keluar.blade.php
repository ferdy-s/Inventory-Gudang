<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Laporan Barang Masuk</title>
  <style>
    @page {
      size: A4 portrait;
      margin: 1.8cm;
    }

    body {
      font-family: Arial, sans-serif;
      color: #222;
      font-size: 12px;
      background: #fff;
      margin: 0;
      padding: 0;
    }

    /* ===== HEADER ===== */
    h1 {
      text-align: center;
      font-size: 18px;
      font-weight: bold;
      color: #000;
      margin-top: 8px;
      margin-bottom: 2px;
    }

    p {
      text-align: center;
      font-size: 11.5px;
      color: #444;
      margin: 0 0 10px 0;
    }

    /* ===== TABLE ===== */
    table {
      width: 100%;
      border-collapse: collapse;
      border: 1px solid #ccc;
      table-layout: fixed;
    }

    thead th {
      background-color: #f2f2f2;
      font-weight: bold;
      text-align: center;
      font-size: 12px;
      padding: 6px 4px;
      border: 1px solid #ccc;
      color: #111;
    }

    tbody td {
      border: 1px solid #ddd;
      padding: 5px 6px;
      font-size: 11.5px;
      font-weight: normal;
      color: #333;
      vertical-align: top;
      text-align: center;
    }

    tbody td:nth-child(4) {
      text-align: left;
      padding-left: 6px;
      width: 35%;
    }

    tbody tr:nth-child(even) {
      background-color: #fafafa;
    }

    /* ===== FOOTER ===== */
    .footer {
      margin-top: 16px;
      font-size: 11px;
      text-align: right;
      color: #555;
    }

    /* ===== PRINT ===== */
    @media print {
      body {
        margin: 0;
        padding: 0;
      }

      thead th {
        background-color: #f2f2f2 !important;
        -webkit-print-color-adjust: exact;
      }

      tbody tr:nth-child(even) {
        background-color: #f9f9f9 !important;
      }

      .footer {
        position: fixed;
        bottom: 12mm;
        right: 20mm;
      }
    }
  </style>
</head>

<body>
  <h1>Laporan Barang Masuk</h1>

  @if ($tanggalMulai && $tanggalSelesai)
    <p>Rentang Tanggal : {{ $tanggalMulai }} - {{ $tanggalSelesai }}</p>
  @else
    <p>Rentang Tanggal : Semua</p>
  @endif

  <table>
    <thead>
      <tr>
        <th style="width:4%;">No</th>
        <th style="width:16%;">Kode Transaksi</th>
        <th style="width:11%;">Tanggal Keluar</th>
        <th style="width:37%;">Nama Barang</th>
        <th style="width:8%;">Jumlah</th>
        <th style="width:24%;">Supplier</th>
      </tr>
    </thead>
    <tbody>
      @foreach($data as $index => $item)
      <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $item->kode_transaksi }}</td>
        <td>{{ $item->tanggal_keluar }}</td>
        <td>{{ $item->nama_barang }}</td>
        <td>{{ $item->jumlah_keluar }}</td>
        <td>{{ $item->customer->customer }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <div class="footer">
    Dicetak oleh: {{ auth()->user()->name }}<br>
    Tanggal: {{ date('d-m-Y') }}
  </div>
</body>
</html>
