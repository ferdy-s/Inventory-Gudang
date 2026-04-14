<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Satuan;
use App\Models\Supplier;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    public function index()
    {
        return view('barang-masuk.index', [
            'barangs'   => Barang::with('satuan')->get(), // 🔥 include satuan
            'suppliers' => Supplier::all()
        ]);
    }

    // ================= DATATABLE =================
    public function getDataBarangMasuk()
    {
        $data = BarangMasuk::with(['barang.satuan', 'supplier'])
            ->latest()
            ->get();

        return response()->json([
            'data' => $data
        ]);
    }

    // ================= STORE =================
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_masuk' => 'required|date',
            'barang_id'     => 'required|exists:barangs,id',
            'jumlah_masuk'  => 'required|numeric|min:1',
            'supplier_id'   => 'required|exists:suppliers,id'
        ]);

        $barang = Barang::findOrFail($request->barang_id);

        $barangMasuk = BarangMasuk::create([
            'tanggal_masuk'  => $request->tanggal_masuk,
            'barang_id'      => $barang->id,
            'jumlah_masuk'   => $request->jumlah_masuk,
            'supplier_id'    => $request->supplier_id,
            'kode_transaksi' => $request->kode_transaksi,
            'user_id'        => auth()->id() ?? 1 // 🔥 aman kalau belum login
        ]);

        // update stok
        $barang->increment('stok', $request->jumlah_masuk);

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $barangMasuk->load(['barang.satuan', 'supplier'])
        ]);
    }

    // ================= DELETE =================
    public function destroy(BarangMasuk $barangMasuk)
    {
        $barang = $barangMasuk->barang;

        if ($barang) {
            $barang->stok = max(0, $barang->stok - $barangMasuk->jumlah_masuk);
            $barang->save();
        }

        $barangMasuk->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Barang Masuk Berhasil Dihapus!'
        ]);
    }

    // ================= DETAIL (UNTUK SATUAN & STOK) =================
    public function getBarangDetail(Request $request)
    {
        $barang = Barang::with('satuan')->find($request->barang_id);

        if (!$barang) {
            return response()->json([
                'stok' => 0,
                'satuan' => '-'
            ]);
        }

        return response()->json([
            'stok'   => $barang->stok ?? 0,
            'satuan' => $barang->satuan->satuan ?? '-' // 🔥 pastikan selalu ada
        ]);
    }

    // ================= GET SATUAN =================
    public function getSatuan()
    {
        return response()->json(Satuan::all());
    }
}
