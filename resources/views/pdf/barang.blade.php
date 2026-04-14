<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<style>

@page {
    margin: 25px;
}

body {
    font-family: DejaVu Sans, sans-serif;
    font-size: 12px;
    color: #222;
}

/* HEADER */
.header {
    text-align: center;
    margin-bottom: 40px;
}

.title {
    font-size: 20px;
    font-weight: bold;
}

.subtitle {
    font-size: 11px;
    color: #777;
}

/* CARD */
.item {
    width: 100%;
}

/* FOTO */
.images {
    text-align: center;
    margin-bottom: 5px;
    margin-top: 25px;
}

.images img {
    width: 190px;
    height: 220px;
    object-fit: cover;
    margin: 10px;
    border-radius: 5px;
    border: 1px solid #ddd;
}

/* TITLE */
.nama {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 10px;
}

/* LINE */
.divider {
    height: 1px;
    background: #eee;
    margin: 10px 0;
}

/* INFO */
.row {
    margin-bottom: 6px;
}

.label {
    display: inline-block;
    width: 140px;
    color: #666;
}

.value {
    display: inline-block;
}

/* STATUS */
.status {
    margin-top: 8px;
    font-weight: bold;
    font-size: 13px;
}

/* DESKRIPSI */
.desc {
    margin-top: 12px;
    font-size: 11px;
    color: #555;
    line-height: 1.7;
    text-align: justify;
    word-wrap: break-word;
}

/* BOX DESKRIPSI */
.desc-box {
    margin-top: 10px;
    padding: 10px;
    border: 1px solid #eee;
    border-radius: 6px;
    background: #fafafa;
}

.footer {
    position: fixed;
    bottom: 10px;
    text-align: center;
    width: 100%;
    font-size: 10px;
    color: #888;
}

</style>

</head>
<body>

<div class="header">
    <div class="title">DETAIL DATA BARANG</div>
    <div class="subtitle">Inventory Management System</div>
</div>

<div class="item">

    <!-- FOTO -->
    <div class="images">
        @foreach(json_decode($item->gambar, true) ?? [] as $img)
            <img src="{{ public_path('storage/'.$img) }}">
        @endforeach
    </div>

    <!-- NAMA -->
    <div class="nama">{{ $item->nama_barang }}</div>

    <div class="divider"></div>

    <!-- DETAIL -->
    <div class="row">
        <span class="label">Jenis</span>
        <span class="value">: {{ $item->jenis->jenis ?? '-' }}</span>
    </div>

    <div class="row">
        <span class="label">Satuan</span>
        <span class="value">: {{ $item->satuan->satuan ?? '-' }}</span>
    </div>

    <div class="row">
        <span class="label">Supplier</span>
        <span class="value">: {{ $item->supplier->supplier ?? '-' }}</span>
    </div>

    <!-- STATUS -->
    <div class="status">
        Status :
        @if($item->stok > 0)
            Ready (Tersedia)
        @else
            Tidak Tersedia
        @endif
    </div>
<br>

    <div class="row">
        <span class="label">Stok Saat Ini</span>
        <span class="value">: {{ $item->stok }}</span>
    </div>

    <div class="row">
        <span class="label">Min Stok</span>
        <span class="value">: {{ $item->stok_minimum }}</span>
    </div>

    <!-- DESKRIPSI -->
    <div class="desc-box">
        <strong style="font-size: 13px;">Deskripsi:</strong><br><br>
        <div class="desc">
            {!! nl2br(e($item->deskripsi)) !!}
        </div>
    </div>

</div>

<div class="footer">
    Dicetak pada {{ now()->format('d M Y H:i') }}
</div>

</body>
</html>
