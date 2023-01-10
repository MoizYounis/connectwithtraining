<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    protected $table = "categories";
    protected $primaryKey = "id";
    // table fields
    protected $guarded = [];
    public $timestamps = false;

}
