<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Filial extends Model
{
    // Table Name
    protected $table = 'filial';
    // Primary Key
    public $primaryKey = 'id';

    public function filial()
    {
        return $this->hasMany('App\Game', 'filial_id');
    }
}
