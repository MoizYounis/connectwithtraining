<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Invoice_order_product_detail extends Model {

    protected $table = "invoice_order_product_details";
    protected $primaryKey = "invoice_id";
    // table fields
    protected $guarded = [];

}
