<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Venturecraft\Revisionable\RevisionableTrait;

class EventContact extends Model
{
    use SoftDeletes, CallableTrait, MeetableTrait,RevisionableTrait;

    protected $connection = 'mysql2';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];
    protected $table = 'managecontacts';

    public function event(){
        return $this->belongsTo(Event::class);
    }

    public function event_type(){
        return $this->hasOne(EventType::class,'id','type_event_id');
    }

}
