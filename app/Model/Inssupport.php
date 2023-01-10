<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Inssupport extends Model {

    protected $table = "instructor_support";
    protected $primaryKey = "id";
    // table fields
    protected $guarded = [];
    public $timestamps = false;
}
