<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Page_meta extends Model {

    protected $table = "page_meta";
    protected $primaryKey = "id";
    // table fields
    protected $guarded = [];
    public $timestamps = false;
}
