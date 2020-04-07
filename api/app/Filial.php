<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Filial extends Model
{
    // Table Name
    protected $table = 'filials';
    // Primary Key
    public $primaryKey = 'id';

    public function game()
    {
        return $this->hasMany('App\Game', 'filial_id');
    }

        public function user()
    {
        return $this->hasMany('App\User', 'filial_id');
    }
}
