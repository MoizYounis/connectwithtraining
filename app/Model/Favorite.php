<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model {

    protected $table = "favorites";
    protected $primaryKey = "id";
    // table fields
    protected $guarded = [];
    public $timestamps = false;
}