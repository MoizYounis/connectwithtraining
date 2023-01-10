<?php

namespace App\MOdel;

use Illuminate\Database\Eloquent\Model;

class General_setting extends Model
{
    protected $primaryKey = 'general_settings_id';
    protected $table = "general_settings";
    // table fields
    protected $guarded = [];
}
