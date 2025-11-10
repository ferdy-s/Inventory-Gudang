@extends('layouts.app')

@section('content')
<!-- =====================================================
     INVENTORY DASHBOARD — CLEAN PURE WHITE THEME FINAL
     Author: DCLIQ System | Version 2025
====================================================== -->

<style>
/* =====================================================
   GLOBAL BASE STYLE
====================================================== */
html, body {
  background: #ffffff !important;
  color: #1e1e1e;
  font-family: 'Poppins', sans-serif;
  margin: 0;
  padding: 0;
  height: 100%;
}

* {
  box-sizing: border-box;
  transition: all 0.2s ease-in-out;
}

/* =====================================================
   HEADER SECTION (NO BACKGROUND CONTAINER)
====================================================== */
.section-header {
  background: transparent !important;
  box-shadow: none !important;
  border: none;
  padding: 0;
  margin-bottom: 1.5rem;
}
.section-header h1 {
  font-size: 1.9rem;
  font-weight: 700;
  color: #1a1a1a;
  letter-spacing: 0.4px;
  margin: 0;
}

/* =====================================================
   SUMMARY CARDS
====================================================== */
.card-statistic-1 {
  background: #ffffff;
  border: 1px solid #ebedf2;
  border-radius: 16px;
  box-shadow: 0 8px 22px rgba(0,0,0,0.03);
  display: flex;
  align-items: center;
  height: 120px;
  transition: 0.3s ease;
}
.card-statistic-1:hover {
  transform: translateY(-3px);
  box-shadow: 0 10px 25px rgba(0,0,0,0.07);
}
.card-statistic-1 .card-icon {
  width: 70px;
  height: 70px;
  border-radius: 14px;
  background: #eef1ff;
  color: #6574ff;
  font-size: 28px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 20px;
}
.card-statistic-1 .card-wrap {
  flex: 1;
}
.card-statistic-1 .card-header {
  border: none;
  background: transparent;
  padding-bottom: 0;
}
.card-statistic-1 .card-header h4 {
  color: #555;
  font-size: 1rem;
  margin: 0;
  font-weight: 500;
}
.card-statistic-1 .card-body {
  color: #111;
  font-size: 1.8rem;
  font-weight: 700;
}

/* =====================================================
   GRAPH SECTION
====================================================== */
.graph-card {
  width: 100%;
  background: #ffffff;
  border: 1px solid #e9ebf4;
  border-radius: 18px;
  box-shadow: 0 6px 18px rgba(0,0,0,0.04);
  margin-top: 2rem;
  padding: 25px 30px;
}
.graph-card .card-header {
  border: none;
  background: transparent;
  padding: 0;
}
.graph-card h4 {
  font-size: 1.1rem;
  font-weight: 600;
  color: #222;
  margin-bottom: 20px;
}
.graph-container {
  position: relative;
  width: 100%;
  height: 360px;
}
.graph-container canvas {
  background: transparent;
  border-radius: 12px;
}

/* =====================================================
   STOCK TABLE SECTION
====================================================== */
.stock-card {
  background: #ffffff;
  border: 1px solid #e9ebf4;
  border-radius: 18px;
  box-shadow: 0 6px 20px rgba(0,0,0,0.04);
  margin-top: 2rem;
  padding: 25px 30px;
}
.stock-card .card-header {
  border: none;
  background: transparent;
  padding: 0;
  margin-bottom: 10px;
}
.stock-card h4 {
  font-size: 1.1rem;
  font-weight: 600;
  color: #222;
}
.table {
  width: 100%;
  border-collapse: separate;
  border-spacing: 0 10px;
  color: #333;
  font-size: 0.9rem;
}
.table thead th {
  background: #f4f6ff;
  color: #444;
  font-weight: 600;
  border: none;
  text-align: left;
  padding: 10px 15px;
  border-radius: 8px;
}
.table tbody tr {
  background: #fff;
  box-shadow: 0 2px 10px rgba(0,0,0,0.03);
  border-radius: 8px;
  transition: 0.2s ease;
}
.table tbody tr:hover {
  background: #fafbff;
}
.table td {
  padding: 12px 15px;
}
.table td:first-child {
  color: #555;
  font-weight: 500;
}
.badge-warning {
  background: linear-gradient(90deg, #ffe381, #ffce54);
  color: #2b2b2b;
  border-radius: 8px;
  padding: 6px 10px;
  font-weight: 600;
  font-size: 0.8rem;
}

/* =====================================================
   FOOTER
====================================================== */
.main-footer {
  text-align: center;
  padding-top: 20px;
  font-size: 0.9rem;
  color: #777;
  border-top: 1px solid #eee;
  background: transparent;
}

/* =====================================================
   RESPONSIVE OPTIMIZATION
====================================================== */
@media (max-width: 992px) {
  .graph-container { height: 300px; }
}
@media (max-width: 768px) {
  .graph-container { height: 260px; }
}
@media (max-width: 576px) {
  .card-statistic-1 { margin-bottom: 15px; }
}
</style>

<!-- =====================================================
     DASHBOARD MAIN CONTENT
====================================================== -->
<div class="section-header">
  <h1>Dashboard</h1>
</div>

<!-- ===== SUMMARY CARDS ===== -->
<div class="row">
  <div class="col-lg-3 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1">
      <div class="card-icon"><i class="fas fa-cubes"></i></div>
      <div class="card-wrap">
        <div class="card-header"><h4>Semua Barang</h4></div>
        <div class="card-body">{{ $barang }}</div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1">
      <div class="card-icon"><i class="fas fa-file-import"></i></div>
      <div class="card-wrap">
        <div class="card-header"><h4>Barang Masuk</h4></div>
        <div class="card-body">{{ $barangMasuk }}</div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1">
      <div class="card-icon"><i class="fas fa-file-export"></i></div>
      <div class="card-wrap">
        <div class="card-header"><h4>Barang Keluar</h4></div>
        <div class="card-body">{{ $barangKeluar }}</div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1">
      <div class="card-icon"><i class="far fa-user"></i></div>
      <div class="card-wrap">
        <div class="card-header"><h4>Pengguna</h4></div>
        <div class="card-body">{{ $user }}</div>
      </div>
    </div>
  </div>
</div>

<!-- ===== GRAPH SECTION ===== -->
<div class="graph-card">
  <div class="card-header">
    <h4>Grafik Barang Masuk & Barang Keluar</h4>
  </div>
  <div class="card-body">
    <div class="graph-container">
      <canvas id="summaryChart"></canvas>
    </div>
  </div>
</div>

<!-- ===== STOCK SECTION ===== -->
<div class="stock-card">
  <div class="card-header">
    <h4>Stok Mencapai Batas Minimum</h4>
  </div>
  <div class="card-body">
    <table class="table">
      <thead>
        <tr>
          <th>No</th>
          <th>Kode Barang</th>
          <th>Nama Barang</th>
          <th>Stok</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($barangMinimum as $barang)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $barang->kode_barang }}</td>
          <td>{{ $barang->nama_barang }}</td>
          <td><span class="badge badge-warning">{{ $barang->stok }}</span></td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<!-- ===== FOOTER ===== -->
<footer class="main-footer">
  Inventaris Gudang © 2025 - DCLIQ Digital System
</footer>

@endsection

<!-- =====================================================
     CHART.JS CONFIGURATION
====================================================== -->
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
  const ctx = document.getElementById('summaryChart').getContext('2d');
  const gradientBlue = ctx.createLinearGradient(0, 0, 0, 400);
  gradientBlue.addColorStop(0, 'rgba(100, 120, 255, 0.7)');
  gradientBlue.addColorStop(1, 'rgba(100, 120, 255, 0.05)');
  const gradientRed = ctx.createLinearGradient(0, 0, 0, 400);
  gradientRed.addColorStop(0, 'rgba(255, 99, 132, 0.6)');
  gradientRed.addColorStop(1, 'rgba(255, 99, 132, 0.05)');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: [
        @foreach($barangMasukData as $data)
          '{{ date("F", strtotime($data->date)) }}',
        @endforeach
      ],
      datasets: [
        {
          label: 'Barang Masuk',
          data: [
            @foreach($barangMasukData as $data)
              '{{ $data->total }}',
            @endforeach
          ],
          backgroundColor: gradientBlue,
          borderRadius: 6,
          borderSkipped: false
        },
        {
          label: 'Barang Keluar',
          data: [
            @foreach($barangKeluarData as $data)
              '{{ $data->total }}',
            @endforeach
          ],
          backgroundColor: gradientRed,
          borderRadius: 6,
          borderSkipped: false
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          position: 'bottom',
          labels: {
            color: '#333',
            boxWidth: 15,
            font: { size: 13, family: 'Poppins' }
          }
        },
        tooltip: {
          backgroundColor: 'rgba(20,20,20,0.9)',
          titleColor: '#fff',
          bodyColor: '#fff',
          padding: 10,
          borderColor: '#6574ff',
          borderWidth: 1,
          cornerRadius: 8
        }
      },
      scales: {
        x: {
          grid: { color: 'rgba(0,0,0,0.05)', drawBorder: false },
          ticks: { color: '#666', font: { size: 12 } }
        },
        y: {
          grid: { color: 'rgba(0,0,0,0.05)', drawBorder: false },
          ticks: { color: '#666', stepSize: 1, precision: 0 },
          beginAtZero: true
        }
      }
    }
  });
});
</script>
@endpush
