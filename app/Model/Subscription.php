<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model {

    protected $table = "subscriptions";
    protected $primaryKey = "id";
    // table fields
    protected $guarded = [];

}
