<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Girl extends Model
{
    protected $fillable = [
        'user_id', 'product_id','number_id','username', 'id_card','id_card_front','id_card_back',
        'real_head','age','native_place','education_id','education',
        'health_card','level','price','service_times','experience',
        'pic_count','order_count','published_at','code'
    ];
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
    public function product(){
        return $this->belongsTo('App\Product','product_id');
    }
}
