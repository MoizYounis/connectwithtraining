<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category_banner extends Model {

    protected $table = "category_banners";
    protected $primaryKey = "id";
    // table fields
    protected $guarded = [];
    public $timestamps = false;

}
