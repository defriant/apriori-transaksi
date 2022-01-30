<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TProduk extends Model
{
    use HasFactory;

    protected $table = 'transaksi_produk';
    protected $fillable = [
        'periode',
        'invoice',
        'id_produk',
        'nama',
        'harga',
        'jumlah',
        'total'
    ];

    public $incrementing = false;

    public function transaksi()
    {
        return $this->hasOne(Transaksi::class, 'id', 'invoice');
    }

    public function produk()
    {
        return $this->hasOne(Produk::class, 'id', 'id_produk');
    }
}
