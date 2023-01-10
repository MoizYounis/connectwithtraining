<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Email_template extends Model {

    protected $table = "email_templates";
    protected $primaryKey = "id";
    // table fields
    protected $guarded = [];
    public $timestamps = false;
}
