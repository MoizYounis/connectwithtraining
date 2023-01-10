<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Popular_gift extends Model {

    protected $table = "popular_gifts";
    protected $primaryKey = "popular_id";
    // table fields
    protected $guarded = [];
    public $timestamps = false;
}
