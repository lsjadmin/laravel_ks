<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class loginModel extends Model
{
    //
    protected $table="p_user";
    public $timestamps = false;
    protected $primaryKey="user_id";
}
