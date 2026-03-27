<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use App\Models\Supplier;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LaporanBarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::orderBy('supplier')->get();

        return view(
            'laporan-barang-masuk.index',
            compact('suppliers')
        );
    }


    /**
     * Get Data
     */
    public function getData(Request $request)
    {
        $query = BarangMasuk::with('supplier');

        if ($request->filled(['tanggal_mulai', 'tanggal_selesai'])) {
            $query->whereBetween('tanggal_masuk', [
                $request->tanggal_mulai,
                $request->tanggal_selesai
            ]);
        }

        if ($request->filled('nama_barang')) {
            $query->where('nama_barang', 'like', '%' . $request->nama_barang . '%');
        }

        if ($request->filled('kode_transaksi')) {
            $query->where('kode_transaksi', 'like', '%' . $request->kode_transaksi . '%');
        }

        if ($request->filled('supplier_id')) {
            $query->where('supplier_id', $request->supplier_id);
        }

        if ($request->filled('jumlah_min')) {
            $query->where('jumlah_masuk', '>=', $request->jumlah_min);
        }

        if ($request->filled('jumlah_max')) {
            $query->where('jumlah_masuk', '<=', $request->jumlah_max);
        }

        return response()->json($query->get());
    }


    /**
     * Print DomPDF
     */
    public function printBarangMasuk(Request $request)
    {
        $query = BarangMasuk::with('supplier');

        // FILTER TANGGAL
        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
            $query->whereBetween('tanggal_masuk', [
                $request->tanggal_mulai,
                $request->tanggal_selesai
            ]);
        }

        // FILTER NAMA BARANG
        if ($request->filled('nama_barang')) {
            $query->where('nama_barang', 'LIKE', '%' . $request->nama_barang . '%');
        }

        // FILTER SUPPLIER
        if ($request->filled('supplier_id')) {
            $query->where('supplier_id', $request->supplier_id);
        }

        $data = $query->get();

        $tanggalMulai   = $request->tanggal_mulai;
        $tanggalSelesai = $request->tanggal_selesai;

        $dompdf = new Dompdf();
        $html = view(
            'laporan-barang-masuk.print-barang-masuk',
            compact('data', 'tanggalMulai', 'tanggalSelesai')
        )->render();

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('laporan-barang-masuk.pdf', ['Attachment' => false]);
    }


    /**
     * Get Supplier
     */
    public function getSupplier()
    {
        $supplier = Supplier::all();
        return response()->json($supplier);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
