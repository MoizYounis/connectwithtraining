<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Business_meta extends Model {

    protected $table = "business_meta";
    protected $primaryKey = "id";
    // table fields
    protected $guarded = [];
    public $timestamps = false;
}
