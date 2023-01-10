<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Location extends Model {

    protected $table = "locations";
    protected $primaryKey = "location_id";
    // table fields
    protected $guarded = [];

}
