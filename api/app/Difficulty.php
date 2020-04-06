<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Difficulty extends Model
{
    // Table Name
    protected $table = 'difficulties';
    // Primary Key
    public $primaryKey = 'id';

    public function game() {
        return $this->hasMany('App\Game', 'difficulties_id');
    }
}
