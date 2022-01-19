<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    public function kategori()
    {
        return $this->belongsTo('App\Models\Kategori');

    }
    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier');

    }
    public function detailtransaksi(){
        return $this->hasMany('App\Models\DetailTransaksi', 'id', 'buku_id');
    }

    
    // public function detailtransaksitemp(){
    //     return $this->hasMany('App\Models\DetailTransaksiTemp', 'id', 'buku_id');
    // }
    use HasFactory;
    protected $fillable = [
        'image', 'kategori_id','supplier_id','deskripsi','kode', 'judul', 'stok', 'harga'
    ];
}
