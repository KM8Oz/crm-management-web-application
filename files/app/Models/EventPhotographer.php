<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Venturecraft\Revisionable\RevisionableTrait;

class EventPhotographer extends Model
{
    use SoftDeletes, CallableTrait, MeetableTrait,RevisionableTrait;

    protected $connection = 'mysql2';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];
    protected $table = 'event_photographers';

    public function event(){
        return $this->hasOne(Event::class);
    }

    public function photographers(){
        return $this->hasOne(Photographers::class,'id','photographer_id');
    }

    public function photographers_trashed(){
        return $this->hasOne(Photographers::class,'id','photographer_id')->withTrashed();
    }

}
