<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Forum_reply extends Model {

    protected $table = "forum_replies";
    protected $primaryKey = "id";
    // table fields
    protected $guarded = [];

}
