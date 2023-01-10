<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model {

    protected $table = "cart";
    protected $primaryKey = "id";
    // table fields
    protected $guarded = [];
    public $timestamps = false;
}
