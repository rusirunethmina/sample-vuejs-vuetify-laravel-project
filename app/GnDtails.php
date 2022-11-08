<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GnDtails extends Model
{
    use SoftDeletes;
    protected $table = 'gn_details';
}
