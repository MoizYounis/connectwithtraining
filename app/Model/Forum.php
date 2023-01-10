<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model {

    protected $table = "forums";
    protected $primaryKey = "id";
    // table fields
    protected $guarded = [];
    //public $timestamps = false;
}
