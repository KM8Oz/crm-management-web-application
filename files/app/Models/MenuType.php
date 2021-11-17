<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Venturecraft\Revisionable\RevisionableTrait;

class MenuType extends Model
{
    use SoftDeletes, CallableTrait, MeetableTrait,RevisionableTrait;

    protected $connection = 'mysql2';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];
    protected $table = 'menu_type';

    public function menu(){
        return $this->belongsTo(Menus::class);
    }

    public function event_menu(){
        return $this->belongsTo(EventMenus::class);
    }

    public function main_menu(){
        return $this->hasOne(MainMenu::class,'id','main_menu_id')->withTrashed();
    }

    public function sub_menu(){
        return $this->hasMany(SubMenu::class,'menu_type','id')->withTrashed();
    }


}
