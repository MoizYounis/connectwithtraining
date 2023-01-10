<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Business extends Model {

    protected $table = "business";
    protected $primaryKey = "id";
    // table fields
    protected $guarded = [];
}
