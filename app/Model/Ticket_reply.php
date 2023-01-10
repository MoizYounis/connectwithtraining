<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Ticket_reply extends Model {

    protected $table = "ticket_reply";
    protected $primaryKey = "id";
    // table fields
    protected $guarded = [];
}
