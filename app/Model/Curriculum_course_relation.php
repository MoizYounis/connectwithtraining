<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Curriculum_course_relation extends Model {

    protected $table = "curriculum_course_relation";
    protected $primaryKey = "id";
    // table fields
    protected $guarded = [];
    public $timestamps = false;
}
