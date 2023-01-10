<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {

    protected $table = "tags";
    protected $primaryKey = "id";
    // table fields
    protected $guarded = [];
    public $timestamps = false;

}
