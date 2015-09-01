<?php

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Events extends Model {

    protected $table = 'event';

    protected $fillable = ['event_name', 'event_date', 'event_detail', 'user_id'];

    protected $hidden = array('created_at', 'updated_at', 'event_id', 'user_id');

    //protected $dates = ['created_at', 'updated_at', 'event_date'];

    /*public function setEventDateAttribute($date){
        this->attributes['event_date'] = Carbon::createFromFormat('Y-m-d', $date);
    }*/

}