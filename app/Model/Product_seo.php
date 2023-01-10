<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product_seo extends Model {

    protected $table = "product_seo";
    protected $primaryKey = "id";
    // table fields
    protected $guarded = [];
    public $timestamps = false;

}
