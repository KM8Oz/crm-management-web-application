<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Venturecraft\Revisionable\RevisionableTrait;

class EventContactUs extends Model
{
    use SoftDeletes, CallableTrait, MeetableTrait,RevisionableTrait;

    protected $connection = 'mysql2';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];
    protected $table = 'contactuses';

    public function event()
    {
        return $this->hasMany(Event::class);
    }


    public function event_type(){
        return $this->belongsTo(EventType::class,"type_event_id","id");
    }

    public function event_type_trashed(){
        return $this->belongsTo(EventType::class,"type_event_id","id")->withTrashed();
    }

}
