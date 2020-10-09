<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prizes extends Model
{
    protected $table = 'prizes';
    protected $fillable = ['name', 'type', 'size', 'file', 'is_taken'];

    public function participants() {
        return $this->hasMany('App\Participants');
    }
}
