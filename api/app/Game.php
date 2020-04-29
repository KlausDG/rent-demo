<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    // Table Name
    protected $table = 'games';
    // Primary Key
    public $primaryKey = 'id';

    public function scopeAvailability($query, $value){
        return $query->where('isAvailable', '=', $value);
    }

    public function scopeFilial($query, $value){
        return $query->where('filial_id', '=', $value);
    }

    public function difficulty()
    {
        return $this->belongsTo('App\Difficulty', 'difficulties_id');
    }

    public function genre()
    {
        return $this->belongsTo('App\Genre', 'genres_id');
    }

    public function language()
    {
        return $this->belongsTo('App\Language', 'languages_id');
    }

    public function filial()
    {
        return $this->belongsTo('App\Filial', 'filial_id');
    }
}
