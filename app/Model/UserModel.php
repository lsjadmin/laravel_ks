<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    //
    protected $table="ks_user";
    public $timestamps = false;
    protected $primaryKey="k_uid";
}
