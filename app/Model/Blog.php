<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model {

    protected $table = "blogs";
    protected $primaryKey = "id";
    // table fields
    protected $guarded = [];

}
