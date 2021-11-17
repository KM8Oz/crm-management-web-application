<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Venturecraft\Revisionable\RevisionableTrait;

class Lead extends Model
{
    use SoftDeletes, CallableTrait, MeetableTrait,RevisionableTrait;

    protected $connection = 'mysql';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];
    protected $table = 'leads';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function salesTeam()
    {
        return $this->belongsTo(Salesteam::class, 'sales_team_id');
    }

    public function customerCompany()
    {
        return $this->belongsTo(Company::class, 'customer_id');
    }

    public function company()
    {
        return $this->hasOne(Company::class, 'id','company_name');
    }

    public function salesPerson()
    {
        return $this->belongsTo(User::class, 'sales_person_id');
    }

    public function eventType(){
        return $this->hasOne(EventType::class,'id','function');
    }

    public function eventTypeTrashed(){
        return $this->hasOne(EventType::class,'id','function')->withTrashed();
    }

    public function location(){
        return $this->hasOne(EventLocations::class,'id','location');
    }

    public function locationTrashed(){
        return $this->hasOne(EventLocations::class,'id','location')->withTrashed();
    }

}
