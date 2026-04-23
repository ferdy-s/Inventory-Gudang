<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    public function index()
    {
        return view('supplier.index', [
            'suppliers' => Supplier::latest()->get()
        ]);
    }

    public function getDataSupplier()
    {
        return response()->json([
            'success' => true,
            'data'    => Supplier::latest()->get()
        ]);
    }

    public function create()
    {
        return view('supplier.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'supplier'  => 'required|string|max:255',
            'alamat'    => 'required|string',
            'deskripsi' => 'nullable|string'
        ], [
            'supplier.required' => 'Form Nama Perusahaan Wajib Di Isi !',
            'alamat.required'   => 'Form Alamat Wajib Diisi'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // 🔥 FIX UTAMA: gunakan user login
        $userId = auth()->id();

        // fallback kalau tidak login (biar tidak error)
        if (!$userId) {
            return response()->json([
                'message' => 'User tidak login'
            ], 401);
        }

      $supplier = Supplier::create([
    'supplier'   => $request->supplier,
    'alamat'     => $request->alamat,
    'deskripsi'  => $request->deskripsi,
    'user_id'    => auth()->id() ?? 1,
]);

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan !',
            'data'    => $supplier
        ]);
    }

    public function show(Supplier $supplier)
    {
        return response()->json([
            'success' => true,
            'data'    => $supplier
        ]);
    }

    public function edit(Supplier $supplier)
    {
        return response()->json([
            'success' => true,
            'message' => 'Edit Data Supplier',
            'data'    => $supplier
        ]);
    }

    public function update(Request $request, Supplier $supplier)
    {
        $validator = Validator::make($request->all(), [
            'supplier'  => 'required|string|max:255',
            'alamat'    => 'required|string',
            'deskripsi' => 'nullable|string'
        ], [
            'supplier.required' => 'Form Nama Perusahaan Wajib Di Isi !',
            'alamat.required'   => 'Form Alamat Wajib Diisi'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $supplier->update([
            'supplier'  => $request->supplier,
            'alamat'    => $request->alamat,
            'deskripsi' => $request->deskripsi,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Terupdate',
            'data'    => $supplier
        ]);
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete(); // ✅ lebih clean dari destroy()

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Dihapus'
        ]);
    }
}
