<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Venturecraft\Revisionable\RevisionableTrait;

class EventRooms extends Model
{
    use SoftDeletes, CallableTrait, MeetableTrait,RevisionableTrait;

    protected $connection = 'mysql2';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];
    protected $table = 'event_rooms';

    function hotel(){
        return $this->hasOne(Hotels::class,'id','hotel_id');
    }

    function hotelTrashed(){
        return $this->hasOne(Hotels::class,'id','hotel_id')->withTrashed();
    }

}
