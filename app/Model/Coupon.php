<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model {

    protected $table = "coupons";
    protected $primaryKey = "coupon_id";
    // table fields
    protected $guarded = [];
    public $timestamps = false;

}
