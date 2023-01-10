<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model {

    protected $table = "banners";
    protected $primaryKey = "banner_id";
    // table fields
    protected $guarded = [];

}
