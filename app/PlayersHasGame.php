<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlayersHasGame extends Model
{
    use SoftDeletes;
    protected $table = 'player_has_game';

    public function Games()
    {
        return $this->belongsTo('App\Game', 'game_id');
    }

    public function Event()
    {
        return $this->belongsTo('App\Event', 'event_id');
    }

    public function player()
    {
        return $this->belongsTo('App\Players', 'player_id');
    }

    function playerGame()
    {
        return $this->hasMany('App\PlayersHasGame', 'player_id');
    }
}
