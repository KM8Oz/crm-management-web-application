<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Venturecraft\Revisionable\RevisionableTrait;

class EventDecorators extends Model
{
    use SoftDeletes, CallableTrait, MeetableTrait,RevisionableTrait;

    protected $connection = 'mysql2';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];
    protected $table = 'event_decorators';

    public function event(){
        return $this->hasOne(Event::class);
    }

    public function decorator(){
        return $this->hasOne(Decorators::class,'id','decorator_id');
    }

    public function decorator_trashed(){
        return $this->hasOne(Decorators::class,'id','decorator_id')->withTrashed();
    }

}
