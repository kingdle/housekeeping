<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'parent_id', 'title', 'icon','hot','is_hidden','services_count','comments_count','followers_count','answers_count'
    ];

    public function girls(){
        return $this->hasMany(Girl::class);
    }
    public function trains(){
        return $this->hasMany(Train::class);
    }
    public function cycles(){
        return $this->hasMany(Cycle::class);
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }
}
