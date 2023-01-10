<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Variant extends Model {

    protected $table = "variants";
    protected $primaryKey = "id";
    // table fields
    protected $guarded = [];
    public $timestamps = false;

}
