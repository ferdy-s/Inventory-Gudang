<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<style>
@page {
    margin: 50px 70px; /* 🔥 kiri kanan lebih lega */
}

body {
    font-family: Helvetica, Arial, sans-serif; /* 🔥 tegas & clean */
    font-size: 12px;
    color: #2b2b2b;
}

/* HEADER */
.header {
    text-align: center;
    margin-bottom: 25px;
}
.title {
    font-size: 20px;
    letter-spacing: 1px;
}
.subtitle {
    font-size: 11px;
    color: #888;
}

/* FOOTER */
.footer {
    position: fixed;
    bottom: 10px;
    text-align: center;
    width: 100%;
    font-size: 10px;
    color: #999;
}

/* PAGE BREAK */
.page-break {
    page-break-before: always;
}

/* ========================= */
/* HALAMAN 1 (GAMBAR PRO) */
/* ========================= */

.image-wrapper {
    margin-top: 45px; /* 🔥 jarak dari header */
}

.image-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 14px; /* 🔥 jarak antar gambar */
}

.image-table td {
    width: 50%;
}

/* BOX GAMBAR */
.image-box {
    height: 240px; /* 🔥 tinggi fix */
    border-radius: 10px;
    overflow: hidden; /* 🔥 crop image */
    border: 1px solid #e6e6e6;
    background: #f9f9f9;
}

.image-box img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* 🔥 POTONG bukan CIUT */
}

/* ========================= */
/* HALAMAN 2 (DETAIL PRO) */
/* ========================= */

.container {
    margin-top: 30px;
}

.nama {
    font-size: 22px;
    letter-spacing: 0.5px;
    text-align: center;
    margin-top: 25px;
}

.divider {
    height: 1px;
    background: #e5e5e5;
    margin: 12px 0 18px;
}

/* INFO */
.row {
    margin-bottom: 8px;
}

.label {
    display: inline-block;
    width: 150px;
    color: #666;
}

.value {
    display: inline-block;
}

/* STATUS */
.status {
    margin-top: 12px;
    padding: 7px 12px;
    border-radius: 6px;
    font-size: 12px;
}

.ready {
    background: #edf7f2;
    color: #1f7a4d;
}

.not-ready {
    background: #fdeeee;
    color: #b02a2a;
}

/* DESKRIPSI */
.desc-box {
    margin-top: 18px;
    padding: 14px;
    border: 1px solid #e5e5e5;
    border-radius: 10px;
    background: #fafafa;
}

.desc-title {
    font-size: 13px;
    margin-bottom: 6px;
}

.desc {
    font-size: 11px;
    color: #555;
    line-height: 1.7;
    text-align: justify;
}
</style>

</head>
<body>

<!-- HEADER -->
<div class="header">
    <div class="title">DETAIL DATA BARANG</div>
    <div class="subtitle">Inventory Management System</div>
</div>

<!-- ========================= -->
<!-- HALAMAN 1 (GRID GAMBAR) -->
<!-- ========================= -->
<div class="image-wrapper">

<table class="image-table">
<tr>

@php $i = 0; @endphp

@foreach(json_decode($item->gambar, true) ?? [] as $img)

<td>
    <div class="image-box">
        <img src="{{ public_path('storage/'.$img) }}">
    </div>
</td>

@php $i++; @endphp

@if($i % 2 == 0)
</tr><tr>
@endif

@endforeach

</tr>
</table>

</div>

<!-- PAGE BREAK -->
<div class="page-break"></div>

<!-- HEADER HALAMAN 2 -->
<div class="header">
    <div class="title">DETAIL DATA BARANG</div>
    <div class="subtitle">Inventory Management System</div>
</div>

<!-- ========================= -->
<!-- HALAMAN 2 (DETAIL) -->
<!-- ========================= -->
<div class="container">

    <div class="nama">{{ $item->nama_barang }}</div>

    <div class="divider"></div>

    <div class="row">
        <span class="label">Jenis</span>
        <span class="value">: {{ $item->jenis->jenis_barang ?? '-' }}</span>
    </div>

    <div class="row">
        <span class="label">Satuan</span>
        <span class="value">: {{ $item->satuan->satuan ?? '-' }}</span>
    </div>

    <div class="row">
        <span class="label">Supplier</span>
        <span class="value">: {{ $item->lastBarangMasuk->supplier->supplier ?? '-' }}</span>
    </div>

    @if($item->stok > 0)
        <div class="status ready">Barang Tersedia</div>
    @else
        <div class="status not-ready">Barang Tidak Tersedia</div>
    @endif

    <br>

    <div class="row">
        <span class="label">Stok Saat Ini</span>
        <span class="value">: {{ $item->stok }}</span>
    </div>

    <div class="row">
        <span class="label">Min Stok</span>
        <span class="value">: {{ $item->stok_minimum }}</span>
    </div>

    <div class="desc-box">
        <div class="desc-title">Deskripsi</div>
        <div class="desc">
            {!! nl2br(e($item->deskripsi)) !!}
        </div>
    </div>

</div>

<!-- FOOTER -->
<div class="footer">
    Dicetak pada {{ now()->format('d M Y H:i') }}
</div>

</body>
</html>