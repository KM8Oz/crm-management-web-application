<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Venturecraft\Revisionable\RevisionableTrait;

class EventBooking extends Model
{
    use SoftDeletes, CallableTrait, MeetableTrait,RevisionableTrait;

    protected $connection = 'mysql2';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];
    protected $table = 'bookingdetails';

    public function event(){
        return $this->hasOne(Event::class,'booking_id');
    }

    public function location(){
        return $this->belongsTo(EventLocations::class,'location_id');
    }

    public function location_trashed(){
        return $this->belongsTo(EventLocations::class,'location_id')->withTrashed();
    }

}
