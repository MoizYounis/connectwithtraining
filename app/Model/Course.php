<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Course extends Model {

    protected $table = "courses";
    protected $primaryKey = "id";
    // table fields
    protected $guarded = [];

}
