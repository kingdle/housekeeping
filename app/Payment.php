<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'id', 'user_id','open_id','to_user_id','type_id', 'customer','goods_name','number_id','quantity',
        'total_fee','timeStamp','package','nonceStr','signType','paySign',
        'remark','times_at','times_end','close_comment','is_hidden',
    ];
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}
