<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';
    protected $fillable = [
        'id',
        'nama',
        'harga'
    ];

    public $incrementing = false;

    public function tproduk()
    {
        return $this->hasMany(TProduk::class, 'id_produk', 'id');
    }
}
