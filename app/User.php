<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone','password','nickname', 'weapp_openid','weapp_session_key', 'union_id','avatar',
        'avatar_url', 'username','id_card','id_card_url','gender',
        'country', 'province','city','city_code','nation_code', 'district', 'latitude', 'longitude', 'location_dir_desc', 'location_title','town', 'street','crossroad','address', 'live_place',
        'language', 'confirmation_token', 'is_active','is_admin','is_hidden','is_subsidy',
        'click_count',
        'questions_count', 'answer_count','comments_count', 'likes_count', 'followers_count','followings_count', 'setting',
    ];


    protected $hidden = [
        'remember_token',
    ];
    public function findForPassport($username)
    {
        filter_var($username, FILTER_VALIDATE_EMAIL) ?
            $credentials['email'] = $username :
            $credentials['phone'] = $username;

        return self::where($credentials)->first();
    }
    public function girl(){
        return $this->hasOne('App\Girl','user_id','id');
    }
    public function train(){
        return $this->hasOne('App\Train','user_id','id');
    }
    public function payment(){
        return $this->hasOne('App\Payment','user_id','id');
    }
    public function order(){
        return $this->hasOne('App\Order','user_id','id');
    }
}
