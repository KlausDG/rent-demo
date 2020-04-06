<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    // Table Name
    protected $table = 'genres';
    // Primary Key
    public $primaryKey = 'id';

    public function game()
    {
        return $this->hasMany('App\Game', 'genres_id');
    }
}
