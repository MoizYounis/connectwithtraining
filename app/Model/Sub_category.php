<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Sub_category extends Model {

    protected $table = "sub_categories";
    protected $primaryKey = "id";
    // table fields
    protected $guarded = [];
    public $timestamps = false;
}
