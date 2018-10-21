<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'to_user_id','service_id', 'product_id','price','discount','fee','city',
        'address','address_full','address_name','latitude','longitude', 'phone','content', 'times_at','times_end',
        'is_native', 'age_at', 'age_end','day_at',
        'rest_mode', 'other_requirements', 'emergency','status','is_pay','status_mean','offer_count',
        'comments_count','likes_count','close_comment','is_hidden','service_at','pay_at'
    ];
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
    public function product(){
        return $this->belongsTo('App\Product','product_id');
    }
}
