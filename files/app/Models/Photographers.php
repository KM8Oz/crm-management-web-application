<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Venturecraft\Revisionable\RevisionableTrait;

class Photographers extends Model
{
    use SoftDeletes, CallableTrait, MeetableTrait,RevisionableTrait;

    protected $connection = 'mysql2';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];
    protected $table = 'photographers';

    public function event_photographers(){
        return $this->belongsTo(EventPhotographer::class);
    }

    public function packages(){
        return $this->hasMany(SupplierPackage::class,'supplier_id');
    }

}
