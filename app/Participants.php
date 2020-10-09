<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participants extends Model
{
    protected $table = 'participants';
    protected $fillable = ['name', 'type', 'prize_id', 'is_choosen'];

    public function prizes() {
        return $this->belongsTo('App\Prizes', 'prize_id');
    }
}
