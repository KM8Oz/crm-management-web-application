<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Venturecraft\Revisionable\RevisionableTrait;

class EventEntertainment extends Model
{
    use SoftDeletes, CallableTrait, MeetableTrait,RevisionableTrait;

    protected $connection = 'mysql2';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];
    protected $table = 'event_entertainment';

    public function event(){
        return $this->hasOne(Event::class);
    }

    public function entertainment(){
        return $this->hasOne(Entertainment::class,'id','entertainment_id');
    }

    public function entertainment_trashed(){
        return $this->hasOne(Entertainment::class,'id','entertainment_id')->withTrashed();
    }

}
