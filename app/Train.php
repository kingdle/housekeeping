<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Train extends Model
{
    protected $fillable = [
        'user_id', 'username','id_card','phone','id_card_front', 'id_card_back',
        'real_head','product_id','cycle_id','cycle_at','title','price','period','address','address_name','latitude','longitude','content',
        'times_at','times_next','times_end','rest_mode','other_training',
        'emergency','batch','is_pay','pay_type','is_phone','likes_count','close_comment','is_hidden'
    ];
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
    public function product(){
        return $this->belongsTo('App\Product','product_id');
    }
}
