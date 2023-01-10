<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model {

    protected $table = "menus";
    protected $primaryKey = "id";
    // table fields
    protected $guarded = [];
    public $timestamps = false;
}
