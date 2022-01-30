<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $fillable = [
        'id',
        'periode',
        'total'
    ];

    public $incrementing = false;

    public function tproduk()
    {
        return $this->hasMany(TProduk::class, 'invoice', 'id');
    }
}
