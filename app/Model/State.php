<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class State extends Model {

    protected $table = "states";
    protected $primaryKey = "state_id";
    // table fields
    protected $guarded = [];

}
