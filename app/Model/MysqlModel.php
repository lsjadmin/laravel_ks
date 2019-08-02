<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MysqlModel extends Model
{
    //
    protected $table="user";
    public $timestamps = false;
    protected $primaryKey="id";
}
