<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'price', 'stock'];

    // Query scope untuk produk mahal
    public function scopeExpensive($query, $price = 1000000)
    {
        return $query->where('price', '>', $price)->orderBy('price', 'desc');
    }

    // Metode untuk mendapatkan rata-rata harga produk
    public static function averagePrice()
    {
        return DB::table('products')->avg('price');
    }
}

