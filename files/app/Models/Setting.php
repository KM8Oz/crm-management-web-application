<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Venturecraft\Revisionable\RevisionableTrait;

class Setting extends Model
{
    use RevisionableTrait;

    protected $dates = ['deleted_at'];
    protected $guarded  = array('id');
    protected $table = 'settings';
    public $timestamps = false;
}
