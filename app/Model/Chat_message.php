<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Chat_message extends Model {

    protected $table = "chat_messages";
    protected $primaryKey = "id";
    // table fields
    protected $guarded = [];

}
