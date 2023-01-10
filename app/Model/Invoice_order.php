<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Invoice_order extends Model {

    protected $table = "invoice_orders";
    protected $primaryKey = "invoice_order_id";
    protected $fillable = [
        'invoice_order_id', 'invoice_no', 'total_price', 'user_id', 'name', 'phone', 
        'email', 'landmark', 'city_id', 'state_id', 'pincode', 'address_type', 'address', 'del_date',
        'order_status', 'coupon_id', 'cancel_reason', 'created_at', 'updated_at',
    ];
    //protected $guarded = [];

}
