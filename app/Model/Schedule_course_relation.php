<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Schedule_course_relation extends Model {

    protected $table = "schedule_course_relation";
    protected $primaryKey = "id";
    // table fields
    protected $guarded = [];
    public $timestamps = false;
}
