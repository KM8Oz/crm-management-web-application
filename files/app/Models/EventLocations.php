<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Venturecraft\Revisionable\RevisionableTrait;

class EventLocations extends Model
{
    use SoftDeletes, CallableTrait, MeetableTrait,RevisionableTrait;
//
    protected $connection = 'mysql2';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];
    protected $table = 'event_location';

    public function booking(){
        return $this->hasMany(EventBooking::class);
    }

}
