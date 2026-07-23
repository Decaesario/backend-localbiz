<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    /**
     * GET /api/produk
     * List semua produk (khusus admin).
     */
    public function index()
    {
        $produk = Produk::all();

        return response()->json([
            'success' => true,
            'message' => 'Daftar produk berhasil diambil',
            'data' => $produk,
        ], 200);
    }

    /**
     * POST /api/produk
     * Tambah produk baru (khusus admin).
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'satuan' => 'required|string|max:50',
            'gambar' => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $request->only(['nama_produk', 'deskripsi', 'harga', 'stok', 'satuan']);

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('produk', 'public');
            $data['gambar'] = $path;
        }

        $produk = Produk::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil ditambahkan',
            'data' => $produk,
        ], 201);
    }

    /**
     * GET /api/produk/{id}
     * Detail 1 produk (khusus admin).
     */
    public function show($id)
    {
        $produk = Produk::find($id);

        if (! $produk) {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan',
                'data' => null,
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail produk berhasil diambil',
            'data' => $produk,
        ], 200);
    }

    /**
     * PUT /api/produk/{id}
     * Update produk (khusus admin).
     */
    public function update(Request $request, $id)
    {
        $produk = Produk::find($id);

        if (! $produk) {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan',
                'data' => null,
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama_produk' => 'sometimes|required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'sometimes|required|numeric|min:0',
            'stok' => 'sometimes|required|integer|min:0',
            'satuan' => 'sometimes|required|string|max:50',
            'gambar' => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $request->only(['nama_produk', 'deskripsi', 'harga', 'stok', 'satuan']);

        if ($request->hasFile('gambar')) {
            if ($produk->gambar) {
                Storage::disk('public')->delete($produk->gambar);
            }
            $path = $request->file('gambar')->store('produk', 'public');
            $data['gambar'] = $path;
        }

        $produk->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil diperbarui',
            'data' => $produk,
        ], 200);
    }

    /**
     * DELETE /api/produk/{id}
     * Hapus produk (khusus admin).
     */
    public function destroy($id)
    {
        $produk = Produk::find($id);

        if (! $produk) {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan',
                'data' => null,
            ], 404);
        }

        if ($produk->gambar) {
            Storage::disk('public')->delete($produk->gambar);
        }

        $produk->delete();

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil dihapus',
            'data' => null,
        ], 200);
    }

    /**
     * GET /api/katalog
     * List produk read-only untuk mobile (customer).
     */
    public function katalog()
    {
        $produk = Produk::select('id', 'nama_produk', 'harga', 'stok', 'satuan', 'gambar')->get();

        return response()->json([
            'success' => true,
            'message' => 'Katalog produk berhasil diambil',
            'data' => $produk,
        ], 200);
    }
}