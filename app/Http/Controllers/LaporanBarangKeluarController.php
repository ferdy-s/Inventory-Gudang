<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use App\Models\Customer;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LaporanBarangKeluarController extends Controller
{
    public function index()
    {
        return view('laporan-barang-keluar.index', [
            'customers' => Customer::all()
        ]);
    }

    public function getData(Request $request)
    {
        $query = BarangKeluar::with(['barang', 'customer']); // ✅ FIX

        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
            $query->whereBetween('tanggal_keluar', [
                $request->tanggal_mulai,
                $request->tanggal_selesai
            ]);
        }

        // ⚠️ kalau kamu masih pakai nama_barang di DB
        if ($request->filled('nama_barang')) {
            $query->whereHas('barang', function ($q) use ($request) {
                $q->where('nama_barang', 'LIKE', '%' . $request->nama_barang . '%');
            });
        }

        if ($request->filled('customer_id')) {
            $query->where('customer_id', $request->customer_id);
        }

        return response()->json($query->get());
    }

    public function printBarangKeluar(Request $request)
    {
        $query = BarangKeluar::with(['barang', 'customer']); // ✅ FIX

        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
            $query->whereBetween('tanggal_keluar', [
                $request->tanggal_mulai,
                $request->tanggal_selesai
            ]);
        }

        if ($request->filled('nama_barang')) {
            $query->whereHas('barang', function ($q) use ($request) {
                $q->where('nama_barang', 'LIKE', '%' . $request->nama_barang . '%');
            });
        }

        if ($request->filled('customer_id')) {
            $query->where('customer_id', $request->customer_id);
        }

        $data = $query->get();

        return view('laporan-barang-keluar.print-barang-keluar', [
            'data' => $data,
            'tanggalMulai' => $request->tanggal_mulai,
            'tanggalSelesai' => $request->tanggal_selesai
        ]);
    }
}
