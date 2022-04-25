<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Penjualan extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_penjualan',
        'id_barang',
        'nama_pembeli',
        'no_hp',
        'jml_barang',
        'total_harga',
    ];

    public function detail_barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }
}
