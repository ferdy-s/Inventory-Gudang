<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class BarangKeluar extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'kode_transaksi',
        'tanggal_keluar',
        'barang_id',
        'jumlah_keluar',
        'customer_id',
        'user_id'
    ];

    // ================= RELASI =================
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    // ================= ACCESSOR =================
    public function getNamaBarangAttribute()
    {
        return $this->barang ? $this->barang->nama_barang : '-';
    }

    // ================= ACTIVITY LOG =================
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly($this->fillable)
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
