<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model {

    protected $table = "contacts";
    protected $primaryKey = "id";
    // table fields
    protected $guarded = [];
    public $timestamps = false;
}
