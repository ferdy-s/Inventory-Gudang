<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Laporan Barang Keluar</title>

  <style>
    @page {
      size: A4 portrait;
      margin: 2cm;
    }

    body {
      font-family: "Segoe UI", Arial, sans-serif;
      background: #f4f6f8;
      margin: 0;
      padding: 0;
      color: #222;
      font-size: 12px;
    }

    /* ===== PAGE WRAPPER ===== */
    .page-wrapper {
      max-width: 900px;
      margin: 0 auto;
      background: #fff;
      padding: 24px 28px;
      box-shadow: 0 0 0 rgba(0,0,0,0);
    }

    /* ===== HEADER ===== */
    h1 {
      text-align: center;
      font-size: 18px;
      margin: 0;
      font-weight: 600;
      letter-spacing: .3px;
    }

    .sub-title {
      text-align: center;
      font-size: 11.5px;
      color: #666;
      margin-top: 6px;
      margin-bottom: 18px;
    }

    /* ===== TABLE ===== */
    table {
      width: 100%;
      border-collapse: collapse;
      table-layout: fixed;
      margin-top: 10px;
    }

    thead th {
      background: #f2f4f7;
      font-size: 12px;
      font-weight: 600;
      text-align: center;
      padding: 8px 6px;
      border: 1px solid #ddd;
      color: #111;
    }

    tbody td {
      border: 1px solid #e1e1e1;
      padding: 7px 6px;
      font-size: 11.5px;
      text-align: center;
      color: #333;
    }

    tbody td:nth-child(4) {
      text-align: left;
      padding-left: 8px;
    }

    tbody tr:nth-child(even) {
      background: #fafafa;
    }

    /* ===== FOOTER ===== */
    .footer {
      margin-top: 22px;
      font-size: 11px;
      text-align: right;
      color: #555;
    }

    /* ===== PRINT ===== */
    @media print {
      body {
        background: #fff;
      }

      .page-wrapper {
        max-width: 100%;
        padding: 0;
      }

      thead th {
        background: #f2f4f7 !important;
        -webkit-print-color-adjust: exact;
      }

      tbody tr:nth-child(even) {
        background: #fafafa !important;
      }

      .footer {
        position: fixed;
        bottom: 14mm;
        right: 20mm;
      }
    }
  </style>
</head>

<body>

  <div class="page-wrapper">

    <h1>Laporan Barang Keluar</h1>

    @if ($tanggalMulai && $tanggalSelesai)
      <div class="sub-title">
        Rentang Tanggal: {{ $tanggalMulai }} - {{ $tanggalSelesai }}
      </div>
    @else
      <div class="sub-title">
        Rentang Tanggal: Semua
      </div>
    @endif

    <table>
      <thead>
        <tr>
          <th style="width:5%">No</th>
          <th style="width:16%">Kode Transaksi</th>
          <th style="width:12%">Tanggal</th>
          <th style="width:35%">Nama Barang</th>
          <th style="width:8%">Jumlah</th>
          <th style="width:24%">Customer</th>
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
      Dicetak oleh: {{ auth()->user()->name }} <br>
      Tanggal: {{ date('d-m-Y') }}
    </div>

  </div>

</body>
</html>
