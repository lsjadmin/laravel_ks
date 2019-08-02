<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BackModel extends Model
{
    //
    protected $table="back";
    public $timestamps = false;
    protected $primaryKey="id";
}
