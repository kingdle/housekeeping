<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'user_id','country', 'province','city','district','town','street','street_number','crossroad','nation_code', 'city_code','adcode',
        'latitude', 'longitude', 'location_title','location_dir_desc', 'live_place',
    ];
}
