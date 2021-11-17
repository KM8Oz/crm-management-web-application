<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Venturecraft\Revisionable\RevisionableTrait;

class Entertainment extends Model
{
    use SoftDeletes, CallableTrait, MeetableTrait,RevisionableTrait;

    protected $connection = 'mysql2';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];
    protected $table = 'entertainment';

    public function event_entertainment(){
        return $this->belongsTo(EventEntertainment::class);
    }

    public function packages(){
        return $this->hasMany(SupplierPackage::class,'supplier_id');
    }

}
