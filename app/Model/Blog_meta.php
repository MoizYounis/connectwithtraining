<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Blog_meta extends Model {

    protected $table = "blog_meta";
    protected $primaryKey = "id";
    // table fields
    protected $guarded = [];
    public $timestamps = false;
}
