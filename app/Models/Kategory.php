<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Str;

class Kategory extends Model
{
    use HasFactory,Sluggable;

    protected $guarded= [];

    public function products()
    {
        return $this->hasMany(Product::class);
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
    // protected static function boot() {
    //     parent::boot();
    //     // ini buat slug category, masih eror
    //     static::creating(function ($category) {
    //         $slug = Str::slug($category->title);

    //         $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();

    //         $category->slug = $count ? "{$slug}-{$count}" : $slug;
    //     });
    // }

}
