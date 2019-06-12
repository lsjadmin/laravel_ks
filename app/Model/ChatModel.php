<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ChatModel extends Model
{
    //
    protected $table="chat";
    public $timestamps = false;
    protected $primaryKey="c_id";
}
