<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model {

    protected $table = "assignments";
    protected $primaryKey = "id";
    // table fields
    protected $guarded = [];

}
