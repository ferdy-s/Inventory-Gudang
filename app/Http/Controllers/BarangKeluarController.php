<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Satuan;
use App\Models\Customer;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('barang-keluar.index', [
            'barangs'           => Barang::all(),
            'barangKeluar'      => BarangKeluar::all(),
            'customers'         => Customer::all()
        ]);
    }

    public function getDataBarangKeluar()
    {
        return response()->json([
            'success'   => true,
            'data' => BarangKeluar::with(['barang', 'customer'])->get(),
            'customer'  => Customer::all()
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('barang-keluar.create', [
            'barangs' => Barang::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggal_keluar' => 'required',
            'nama_barang'    => 'required',
            'customer_id'    => 'required',
            'jumlah_keluar'  => 'required|numeric|min:1',
        ], [
            'tanggal_keluar.required' => 'Tanggal wajib diisi!',
            'nama_barang.required'    => 'Nama barang wajib diisi!',
            'jumlah_keluar.required'  => 'Jumlah wajib diisi!',
            'customer_id.required'    => 'Pilih customer!'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // 🔥 ambil barang sekali saja
        $barang = Barang::where('nama_barang', $request->nama_barang)->first();

        if (!$barang) {
            return response()->json(['message' => 'Barang tidak ditemukan'], 422);
        }

        // 🔥 VALIDASI STOK
        if ($request->jumlah_keluar > $barang->stok) {
            return response()->json([
                'message' => 'Stok tidak cukup!'
            ], 422);
        }

        // 🔥 SIMPAN DATA
        $barangKeluar = BarangKeluar::create([
            'tanggal_keluar' => $request->tanggal_keluar,
            'barang_id'      => $barang->id,
            'jumlah_keluar'  => $request->jumlah_keluar,
            'customer_id'    => $request->customer_id,
            'kode_transaksi' => $request->kode_transaksi,
            'user_id'        => auth()->id()
        ]);

        // 🔥 UPDATE STOK (AMAN)
        $barang->stok -= $request->jumlah_keluar;
        $barang->stok = max(0, $barang->stok); // 🔥 anti minus
        $barang->save();

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $barangKeluar
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(BarangKeluar $barangKeluar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BarangKeluar $barangKeluar)
    {
        return response()->json([
            'success' => true,
            'message' => 'Edit Data Barang',
            'data'    => $barangKeluar
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BarangKeluar $barangKeluar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BarangKeluar $barangKeluar)
    {
        $jumlahKeluar = $barangKeluar->jumlah_keluar;

        // 🔥 ambil barang dari RELASI (bukan nama_barang)
        $barang = Barang::find($barangKeluar->barang_id);

        $barangKeluar->delete();

        if ($barang) {
            $barang->stok += $jumlahKeluar;

            // 🔥 safety (tidak perlu minus check karena tambah)
            $barang->stok = max(0, $barang->stok);

            $barang->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Dihapus!'
        ]);
    }

    /**
     * Create Autocomplete Data
     */
    public function getAutoCompleteData(Request $request)
    {
        $barang = Barang::where('nama_barang', $request->nama_barang)->first();

        if ($barang) {
            return response()->json([
                'nama_barang'   => $barang->nama_barang,
                'stok'          => $barang->stok,
                'satuan_id'     => $barang->satuan_id,
            ]);
        }
    }

    /**
     * Create Autocomplete Data In Update Method
     */

    public function getStok(Request $request)
    {
        $namaBarang = $request->input('nama_barang');
        $barang = Barang::where('nama_barang', $namaBarang)->select('stok', 'satuan_id')->first();

        $response = [
            'stok'          => $barang->stok,
            'satuan_id'     => $barang->satuan_id
        ];

        return response()->json($response);
    }

    public function getSatuan()
    {
        $satuans = Satuan::all();

        return response()->json($satuans);
    }

    public function getBarangs(Request $request)
    {
        if ($request->has('q')) {
            $barangs = Barang::where('nama_barang', 'like', '%' . $request->input('q') . '%')->get();
            return response()->json($barangs);
        }

        return response()->json([]);
    }
}
