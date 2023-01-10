<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User_address extends Model {

    protected $table = "user_addresses";
    protected $primaryKey = "id";
    // table fields
    protected $guarded = [];
}
