<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model {

    protected $table = "certificates";
    protected $primaryKey = "id";
    // table fields
    protected $guarded = [];
    public $timestamps = false;
}
