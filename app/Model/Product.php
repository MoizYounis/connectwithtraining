<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    protected $table = "products";
    protected $primaryKey = "id";
    // table fields
    protected $guarded = [];
}
