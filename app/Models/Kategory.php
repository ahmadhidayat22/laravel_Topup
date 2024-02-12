<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategory extends Model
{
    use HasFactory;

    protected $guarded= [];

    public function product_pasca(){
        return $this->hasMany(product_pasca::class);
    }
}
