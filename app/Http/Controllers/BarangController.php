<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use App\Models\Barang;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Satuan;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;



class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('barang.index', [
            'barangs'         => Barang::all(),
            'jenis_barangs'   => Jenis::all(),
            'satuans'         => Satuan::all()
        ]);
    }

    public function getDataBarang()
    {
        try {
            $barangs = Barang::all();

            return response()->json([
                'success' => true,
                'data' => $barangs
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('barang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_barang'   => 'required',
            'deskripsi'     => 'required',
            'gambar'        => 'required|array|max:20',
            'gambar.*'      => 'image|mimes:jpeg,png,jpg|max:2048',
            'stok_minimum'  => 'required|numeric',
            'jenis_id'      => 'required',
            'satuan_id'     => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $images = [];

        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                $path = $file->store('gambar-barang', 'public');
                $images[] = $path;
            }
        }

        $kode_barang = 'PRPTY-' . str_pad(rand(1, 99999), 5, '0', STR_PAD_LEFT);

        $barang = Barang::create([
            'nama_barang'   => $request->nama_barang,
            'deskripsi'     => $request->deskripsi,
            'user_id'       => auth()->user()->id,
            'kode_barang'   => $kode_barang,
            'gambar'        => json_encode($images),
            'stok_minimum'  => $request->stok_minimum,
            'jenis_id'      => $request->jenis_id,
            'satuan_id'     => $request->satuan_id
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $barang
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        $barang->load(['jenis', 'satuan']); // WAJIB

        return response()->json([
            'success' => true,
            'data' => $barang
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        return response()->json([
            'success' => true,
            'message' => 'Edit Data Barang',
            'data'    => $barang
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang)
    {
        $validator = Validator::make($request->all(), [
            'nama_barang'   => 'required',
            'deskripsi'     => 'required',
            'gambar'        => 'nullable|array|max:20',
            'gambar.*'      => 'image|mimes:jpeg,png,jpg|max:2048',
            'stok_minimum'  => 'required|numeric',
            'jenis_id'      => 'required',
            'satuan_id'     => 'required'
        ], [
            'nama_barang.required'  => 'Form Nama Barang Wajib Di Isi !',
            'deskripsi.required'    => 'Form Deskripsi Wajib Di Isi !',
            'stok_minimum.required' => 'Form Stok Minimum Wajib Di Isi !',
            'stok_minimum.numeric'  => 'Gunakan Angka!',
            'jenis_id.required'     => 'Pilih Jenis Barang!',
            'satuan_id.required'    => 'Pilih Satuan Barang!',
            'gambar.array'          => 'Harus multiple file!',
            'gambar.max'            => 'Max 20 gambar!',
            'gambar.*.image'        => 'Harus gambar!',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // ambil gambar lama
        $oldImages = [];

        if ($barang->gambar) {
            $decoded = json_decode($barang->gambar, true);

            // jika JSON valid
            if (is_array($decoded)) {
                $oldImages = $decoded;
            } else {
                // fallback kalau masih single image lama
                $oldImages = [$barang->gambar];
            }
        }
        $images = $oldImages;

        // jika upload baru
        if ($request->hasFile('gambar')) {

            // hapus lama
            if (!empty($oldImages)) {
                foreach ($oldImages as $img) {
                    if (Storage::exists('public/' . $img)) {
                        Storage::delete('public/' . $img);
                    }
                }
            }

            $images = [];

            foreach ($request->file('gambar') as $file) {
                $path = $file->store('gambar-barang', 'public');
                $images[] = $path;
            }
        }

        $barang->update([
            'nama_barang'   => $request->nama_barang,
            'stok_minimum'  => $request->stok_minimum,
            'deskripsi'     => $request->deskripsi,
            'user_id'       => auth()->user()->id,
            'gambar'        => json_encode($images),
            'jenis_id'      => $request->jenis_id,
            'satuan_id'     => $request->satuan_id
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diupdate',
            'data'    => $barang
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
  public function destroy($id)
{
    try {
        $barang = Barang::find($id);

        if (!$barang) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        // 🔥 OPTIONAL: hapus relasi manual (kalau ada)
        // DB::table('barang_masuks')->where('barang_id', $id)->delete();
        // DB::table('barang_keluars')->where('barang_id', $id)->delete();

        $barang->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus'
        ]);

    } catch (\Exception $e) {

        // 🔥 DEBUG REAL ERROR
        return response()->json([
            'success' => false,
            'error' => $e->getMessage(),
            'line' => $e->getLine(),
            'file' => $e->getFile()
        ], 500);
    }
}

    public function cetakPdf($id)
    {
        $item = Barang::with(['jenis', 'satuan', 'lastBarangMasuk.supplier'])->findOrFail($id);

        $pdf = Pdf::loadView('pdf.barang', compact('item'));

        return $pdf->stream('detail-barang.pdf');
    }
}
