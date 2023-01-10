<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Child_category extends Model {

    protected $table = "child_categories";
    protected $primaryKey = "id";
    // table fields
    protected $guarded = [];
    public $timestamps = false;
}
