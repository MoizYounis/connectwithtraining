<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model {

    protected $table = "payments";
    protected $primaryKey = "payment_id";
    protected $guarded = [];
}
