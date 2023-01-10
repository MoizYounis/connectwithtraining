<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Test extends Model {

    protected $table = "tests";
    protected $primaryKey = "id";
    // table fields
    protected $guarded = [];

}
