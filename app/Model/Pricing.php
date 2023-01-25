<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Pricing extends Model {

    protected $table = "pricings";
    protected $primaryKey = "id";
    // table fields
    protected $guarded = [];
    public $timestamps = false;
}
