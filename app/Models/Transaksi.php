<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    public function detailtransaksi(){
        return $this->hasMany('App\Models\DetailTransaksi', 'id', 'transaksi_id');
    }

    use HasFactory;
    protected $fillable = [
        'user_id','nomor_nota','nama_pembeli','alamat_pembeli', 'total_pembelian', 'status'
    ];
}
