<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model {

    protected $table = "schedules";
    protected $primaryKey = "id";
    // table fields
    protected $guarded = [];
}
