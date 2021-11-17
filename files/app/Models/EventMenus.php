<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Venturecraft\Revisionable\RevisionableTrait;

class EventMenus extends Model
{
    use SoftDeletes, CallableTrait, MeetableTrait,RevisionableTrait;

    protected $connection = 'mysql2';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];
    protected $table = 'event_menu';

    public function event(){
        return $this->hasMany(Event::class);
    }

    public function menu_type(){
        return $this->hasMany(SubMenu::class,'id','sub_menu_id');
    }

    public function menu_type_trashed(){
        return $this->hasMany(SubMenu::class,'id','sub_menu_id')->withTrashed();
    }

}
