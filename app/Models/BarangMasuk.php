<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class BarangMasuk extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'kode_transaksi',
        'tanggal_masuk',
        'barang_id',
        'jumlah_masuk',
        'supplier_id',
        'user_id'
    ];

    protected $ignoreChangedAttributes = ['updated_at'];

    // ================= RELASI =================
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    // ================= ACCESSOR =================
    public function getNamaBarangAttribute()
    {
        return $this->barang ? $this->barang->nama_barang : '-';
    }

    // ================= LOG =================
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly($this->fillable)
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    public function getSatuanAttribute()
    {
        return $this->barang && $this->barang->satuan
            ? $this->barang->satuan->satuan
            : '-';
    }

    public function getStokAttribute()
    {
        return $this->barang
            ? $this->barang->stok
            : 0;
    }
}
