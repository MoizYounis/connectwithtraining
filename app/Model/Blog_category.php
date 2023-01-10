<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Blog_category extends Model {

    protected $table = "blog_categories";
    protected $primaryKey = "id";
    // table fields
    protected $guarded = [];
    public $timestamps = false;
}
