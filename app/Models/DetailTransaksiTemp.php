<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksiTemp extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','buku_id','quantity', 'total_harga'
    ];

    public function buku()
    {
        return $this->hasOne(Buku::class, 'id','buku_id');
    }
}
