<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class City extends Model {

    protected $table = "cities";
    protected $primaryKey = "city_id";
    // table fields
    protected $guarded = [];

}
