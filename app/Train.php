<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Train extends Model
{
    protected $fillable = [
        'user_id', 'username','id_card','id_card_front', 'id_card_back',
        'real_head','product_id','title','price','period','address','content',
        'times_at','times_next','times_end','rest_mode','other_training',
        'emergency','batch','is_pay','likes_count','close_comment','is_hidden'
    ];
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
    public function product(){
        return $this->belongsTo('App\Product','product_id');
    }
}
