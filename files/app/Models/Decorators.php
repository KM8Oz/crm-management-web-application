<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Venturecraft\Revisionable\RevisionableTrait;

class Decorators extends Model
{
    use SoftDeletes, CallableTrait, MeetableTrait,RevisionableTrait;

    protected $connection = 'mysql2';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];
    protected $table = 'decorators';

    public function event_decorators(){
        return $this->belongsTo(EventDecorators::class);
    }

    public function packages(){
        return $this->hasMany(SupplierPackage::class,'supplier_id');
    }

}
