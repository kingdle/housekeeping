<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cycle extends Model
{
    protected $fillable = [
        'user_id', 'product_id','title','price','period','times_at','times_end','trains_count','enrolments_count',
        'longitude','latitude','address','address_name','linkman','phone','remark',
        'close_comment','is_hidden'
    ];

    public function product(){
        return $this->belongsTo('App\Product','product_id');
    }
}
