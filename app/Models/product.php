<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Cviebrock\EloquentSluggable\Sluggable;

class product extends Model
{
    use HasFactory,Sluggable;

    protected $guarded= [];

    // public function product_prepaid(){
    //     return $this->hasMany(product_prepaid::class);
    // }
    // public function product_pasca(){
    //     return $this->hasMany(product_pasca::class);
    // }

    public function category()
    {
        return $this->belongsTo(Kategory::class, 'fk_category');
    }
    public function product_details()
    {
        return $this->belongsTo(product_details::class);
        
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
                'unique' => true,
            ]
        ];
    }
}
