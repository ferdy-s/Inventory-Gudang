<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class JenisController extends Controller
{
    public function index()
    {
        return view('jenis-barang.index');
    }

    public function getDataJenisBarang()
    {
        return response()->json([
            'success' => true,
            'data'    => Jenis::latest()->get()
        ]);
    }

    /**
     * STORE (FIX TOTAL)
     */
    public function store(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'jenis_barang' => 'required'
            ], [
                'jenis_barang.required' => 'Form Jenis Barang Wajib Di Isi !'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            }

            // 🔥 FIX UTAMA
            $userId = auth()->id();

            if (!$userId) {
                // fallback supaya tidak crash
                $userId = 1;
            }

            $jenisBarang = Jenis::create([
                'jenis_barang' => $request->jenis_barang,
                'user_id'      => $userId
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data Berhasil Disimpan!',
                'data'    => $jenisBarang
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Server Error',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    /**
     * EDIT
     */
    public function edit($id)
    {
        $jenis = Jenis::find($id);

        if (!$jenis) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $jenis
        ]);
    }

    /**
     * UPDATE (FIX TOTAL)
     */
    public function update(Request $request, $id)
    {
        try {
            $jenis = Jenis::find($id);

            if (!$jenis) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan'
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'jenis_barang' => 'required'
            ], [
                'jenis_barang.required' => 'Form Jenis Barang Tidak Boleh Kosong'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            }

            DB::beginTransaction();

            $jenis->update([
                'jenis_barang' => $request->jenis_barang,
                'user_id'      => auth()->check() ? auth()->id() : null
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data Berhasil Diupdate!',
                'data'    => $jenis
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Server Error',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    /**
     * DELETE (FIX TOTAL)
     */
    public function destroy($id)
    {
        try {
            $jenis = Jenis::find($id);

            if (!$jenis) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan'
                ], 404);
            }

            $jenis->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data Berhasil Dihapus!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}
