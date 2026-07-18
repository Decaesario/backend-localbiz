<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    protected $table = 'pengiriman';

    protected $fillable = [
        'pesanan_id',
        'nama_kurir',
        'status_pengiriman',
        'waktu_berangkat',
        'waktu_sampai',
        'jumlah_setoran',
        'bukti_setoran',
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }
}