<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Produk;

class DashboardController extends Controller
{
    /**
     * GET /api/dashboard
     * Ringkasan total produk, total pesanan, dan breakdown status pesanan.
     */
    public function index()
    {
        $totalProduk = Produk::count();
        $totalPesanan = Pesanan::count();

        $statusPesanan = Pesanan::selectRaw('status, count(*) as jumlah')
            ->groupBy('status')
            ->pluck('jumlah', 'status');

        return response()->json([
            'success' => true,
            'message' => 'Data dashboard berhasil diambil',
            'data' => [
                'total_produk' => $totalProduk,
                'total_pesanan' => $totalPesanan,
                'status_pesanan' => $statusPesanan,
            ],
        ], 200);
    }
}