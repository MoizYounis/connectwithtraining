<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Video extends Model {

    protected $table = "videos";
    protected $primaryKey = "id";
    // table fields
    protected $guarded = [];

}
