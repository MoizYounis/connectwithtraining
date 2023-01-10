<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Permission extends Model {

    protected $table = "permissions";
    protected $primaryKey = "id";
    // table fields
    protected $guarded = [];
    public $timestamps = false;

    public function getPermission()
    {
        $result = array();
        $roles =  DB::table('permissions as p')
                    ->where('p.user_type_id', Auth()->user()->user_type_id)
                    ->first();
		return $roles;
    }
}
