<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_details extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function product(){
        return $this->hasMany(product::class);
    }
}
