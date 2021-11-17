<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Venturecraft\Revisionable\RevisionableTrait;

class SubMenu extends Model
{
    use SoftDeletes, CallableTrait, MeetableTrait,RevisionableTrait;

    protected $connection = 'mysql2';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];
    protected $table = 'sub_menu';

    public function main_menu(){
        return $this->hasOne(MainMenu::class,'id','main_menu_id')->withTrashed();
    }

    public function menu_type_data(){
        return $this->hasOne(MenuType::class,'id','menu_type')->withTrashed();
    }

    public function menu(){
        return $this->hasMany(Menus::class,'sub_menu_id','id');
    }

}
