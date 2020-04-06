<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    // Table Name
    protected $table = 'languages';
    // Primary Key
    public $primaryKey = 'id';

    public function game()
    {
        return $this->hasMany('App\Game', 'languages_id');
    }
}
