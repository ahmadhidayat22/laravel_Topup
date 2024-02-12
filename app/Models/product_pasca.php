<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_pasca extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }
    public function kategory(){
        return $this->belongsTo(Kategory::class);
    }
     
    public function product(){
        return $this->belongsTo(Product::class);
    }

}
