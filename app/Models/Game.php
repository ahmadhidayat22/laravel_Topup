<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function gameDetails()
    {
        return $this->hasMany(game_details::class);
    }
}
