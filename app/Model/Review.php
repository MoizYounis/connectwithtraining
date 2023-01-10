<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Review extends Model {

    protected $table = "reviews";
    protected $primaryKey = "id";
    // table fields
    protected $guarded = [];

}
