<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Venturecraft\Revisionable\RevisionableTrait;

class EventPayments extends Model
{
    use SoftDeletes, CallableTrait, MeetableTrait,RevisionableTrait;

    protected $connection = 'mysql2';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];
    protected $table = 'payments';

    public function paymentMethod(){
        return $this->belongsTo(EventDepositType::class,'payment_method');
    }

    public function event(){
        return $this->hasOne(Event::class,'id','event_id');
    }

}
