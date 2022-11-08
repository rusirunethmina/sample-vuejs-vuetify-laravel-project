<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GameHasEvent extends Model
{
    use SoftDeletes;
    protected $table = 'game_has_event';

    public function Games()
    {
        return $this->belongsTo('App\Game', 'game_id');
    }

    public function Event()
    {
        return $this->belongsTo('App\Event', 'event_id');
    }
}
