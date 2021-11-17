<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Venturecraft\Revisionable\RevisionableTrait;

class Event extends Model
{
    use SoftDeletes, CallableTrait, MeetableTrait,RevisionableTrait;

    protected $connection = 'mysql2';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];
    protected $table = 'eventdetails';

    public function lead(){
        return $this->hasOne(Lead::class,'id','from_lead');
    }

    public function booking(){
        return $this->belongsTo(EventBooking::class);
    }

    public function contacts(){
        return $this->hasMany(EventContact::class);
    }

    public function notes(){
        return $this->hasMany(EventNotes::class);
    }

    public function additional(){
        return $this->hasOne(EventAdditionalInfo::class);
    }

    public function setuptear(){
        return $this->hasOne(EventSetupTear::class);
    }

    public function tasks(){
        return $this->hasMany(EventTasks::class);
    }

    public function contactus(){
        return $this->hasOne(EventContactUs::class);
    }

    public function financials(){
        return $this->hasOne(EventFinancials::class);
    }

    public function discussion(){
        return $this->hasMany(EventDiscussion::class);
    }

    public function deposit(){
        return $this->hasOne(EventDeposit::class);
    }

    public function kids(){
        return $this->hasOne(EventKids::class);
    }

    public function event_menu(){
        return $this->hasMany(EventMenus::class);
    }

    public function event_menu_trashed(){
        return $this->hasMany(EventMenus::class)->withTrashed();
    }

    public function event_document(){
        return $this->hasMany(EventDocument::class);
    }

    public function payment(){
        return $this->hasMany(EventPayments::class);
    }

    public function eating_times(){
        return $this->hasOne(EventEatingTimes::class);
    }

    public function event_equipment(){
        return $this->hasOne(EventEquipment::class);
    }

    public function event_equipment_trashed(){
        return $this->hasOne(EventEquipment::class)->withTrashed();
    }

    public function event_photographers(){
        return $this->hasOne(EventPhotographer::class);
    }

    public function event_miscellaneous(){
        return $this->hasOne(Miscellaneous::class);
    }

    public function event_photographers_trashed(){
        return $this->hasOne(EventPhotographer::class)->withTrashed();
    }

    public function event_entertainment(){
        return $this->hasOne(EventEntertainment::class);
    }

    public function event_entertainment_trashed(){
        return $this->hasOne(EventEntertainment::class)->withTrashed();
    }

    public function event_parking(){
        return $this->hasOne(EventParking::class);
    }

    public function event_parking_trashed(){
        return $this->hasOne(EventParking::class)->withTrashed();
    }

    public function event_decorator(){
        return $this->hasOne(EventDecorators::class);
    }

    public function event_decorator_trashed(){
        return $this->hasOne(EventDecorators::class)->withTrashed();
    }

    public function owner(){
        return $this->hasOne(User::class,'id','owner_id');
    }

    public function owner_trashed(){
        return $this->hasOne(User::class,'id','owner_id')->withTrashed();
    }

    public function sales_team_id(){
        return $this->hasOne(Salesteam::class,'id','sales_team_id');
    }

    public function sales_team_id_trashed(){
        return $this->hasOne(Salesteam::class,'id','sales_team_id')->withTrashed();
    }

    public function user(){
        return $this->hasOne(User::class,'id','created_by')->withTrashed();
    }

    public function leadSources(){
        return $this->belongsTo(LeadSource::class,"leadsources_id","id");
    }

    public function leadSources_trashed(){
        return $this->belongsTo(LeadSource::class,"leadsources_id","id")->withTrashed();
    }

    public function logistics()
    {
        return $this->hasOne(EventGuestPickup::class);
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

}
