<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class EventModel extends Model
{
    //
    protected $table="event";
    public $timestamps = false;
    protected $primaryKey="e_id";
}
