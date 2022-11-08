<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Players extends Model
{
    use SoftDeletes;
    protected $table = 'players';

    function playerGame()
    {
        return $this->hasMany('App\PlayersHasGame', 'player_id');
    }

    // function playerEvent()
    // {
    //     return $this->hasMany('App\PlayersHasGame', 'event_id');
    // }
}
