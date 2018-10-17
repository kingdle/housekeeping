<?php

namespace App\Http\Controllers;

use App\Location;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Iwanli\Wxxcx\Wxxcx;

class UsersController extends Controller
{
    protected $wxxcx;

    function __construct(Wxxcx $wxxcx)
    {
        $this->wxxcx = $wxxcx;
    }
    public function weapplogin(Request $request)
    {
        $code = $request->code;
        // 根据 code 获取微信 openid 和 session_key
        $miniProgram = \EasyWeChat::miniProgram();
        $data = $miniProgram->auth->session($code);

        if (isset($data['errcode'])) {
            return $this->response->errorUnauthorized('code已过期或不正确');
        }
        $weappOpenid = $data['openid'];
        $weixinSessionKey = $data['session_key'];
        if($request->nickname){
            $nickname = $request->nickname;
        }else{
            $nickname = '';
        }
        if($request->avatar){
            $avatar = $request->avatar;
        }else{
            $avatar = '';
        }
        if($request->country){
            $country = $request->country;
            $attributes['country'] = $country;
        }else{
            $country = '';
        }
        if($request->province){
            $province = $request->province;
            $attributes['province'] = $province;
        }else{
            $province = '';
        }
        if($request->city){
            $city = $request->city;
            $attributes['city'] = $city;
        }else{
            $city = '';
        }
        if($request->gender){
            $gender = $request->gender;
            $attributes['gender'] = $gender;
        }else{
            $gender = '0';
        }
        //找到 openid 对应的用户
        $user = User::where('weapp_openid', $weappOpenid)->first();
        //把session_key
        $attributes['weapp_session_key'] = $weixinSessionKey;

        if($request->nickname){
            $attributes['nickname'] = $nickname;
        }
        if (!$user) {
            if($avatar){
                $avatarfile = file_get_contents($avatar);
                $filename = 'avatars/'.$weappOpenid.'housekeeping'.uniqid().'.png';
                Storage::disk('upyun')->write($filename, $avatarfile);
                $userAvatar=config('filesystems.disks.upyun.protocol').'://'.config('filesystems.disks.upyun.domain').'/'.$filename;
            }
            User::create([
                'weapp_openid' => $weappOpenid,
                'weapp_session_key' => $weixinSessionKey,
                'is_active' => 0,
                'avatar' => $avatar,
                'avatar_url' => $userAvatar,
                'nickname' => $nickname,
                'country' => $country,
                'province' => $province,
                'city' => $city,
                'gender' => $gender,
            ]);
            // 获取对应的用户
            $user = User::where('weapp_openid', $weappOpenid)->first();
            $attributes['weapp_openid'] = $weappOpenid;
        }
        // 更新用户数据
        $user->update($attributes);
        // 直接创建token并设置有效期
        $createToken = $user->createToken($user->weapp_openid);
        $createToken->token->expires_at = Carbon::now()->addDays(15);
        $createToken->token->save();
        $token = $createToken->accessToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => "Bearer",
            'expires_in' => '21600',
            'data'=>$user
        ], 200);
    }
    public function getOpenid(Request $request){
            $code = $request->code;
            $miniProgram = \EasyWeChat::miniProgram();
            $data = $miniProgram->auth->session($code);

            if (isset($data['errcode'])) {
                return $this->response->errorUnauthorized('code已过期或不正确');
            }
            $weappOpenid = $data['openid'];
            $weixinSessionKey = $data['session_key'];
            return $data;
    }
    public function weappupdate(Request $request)
    {
        $userId = Auth::guard('api')->user()->id;
        $user = User::where('id', $userId)->first();

        $attributes['country'] = $request->country;
        $attributes['province'] = $request->province;
        $attributes['city'] = $request->city;
        $attributes['district'] = $request->district;
        $attributes['town'] = $request->town;
        $attributes['street'] = $request->street;
        $attributes['crossroad'] = $request->crossroad;
        $attributes['nation_code'] = $request->nation_code;
        $attributes['city_code'] = $request->city_code;
        $attributes['latitude'] = $request->latitude;
        $attributes['longitude'] = $request->longitude;
        $attributes['location_title'] = $request->location_title;
        $attributes['location_dir_desc'] = $request->location_dir_desc;
        $attributes['live_place'] = $request->live_place;
        // 更新用户数据
        $user->update($attributes);

        Location::create([
            'user_id' => $userId,
            'country' => $request->country,
            'province' => $request->province,
            'city' => $request->city,
            'district' => $request->district,
            'town' => $request->town,
            'street' => $request->street,
            'street_number' => $request->street_number,
            'crossroad' => $request->crossroad,
            'nation_code' => $request->nation_code,
            'city_code' => $request->city_code,
            'adcode' => $request->adcode,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'location_title' => $request->location_title,
            'location_dir_desc' => $request->location_dir_desc,
            'live_place' => $request->live_place,
        ]);

        return response()->json([
            'data'=>$user
        ], 200);
    }
    public function getPhone(Request $request)
    {
        $code = request('code', '');
        $encryptedData = request('encryptedData', '');
        $iv = request('iv', '');
        //根据 code 获取用户 session_key 等信息, 返回用户openid 和 session_key
        $userInfo = $this->wxxcx->getLoginInfo($code);
        //获取解密后的用户信息
        $wxinfo=$this->wxxcx->getUserInfo($encryptedData, $iv);
        return $wxinfo;
    }
    public function userPhoneUpdate(Request $request)
    {
        $userid = Auth::guard('api')->user()->id;
        $user = User::find($userid);
        $attributes['phone'] = request('phoneNumber', '');
        // 更新用户数据
        $user->update($attributes);
        return response()->json([
            'data'=>$user
        ], 200);
    }
    public function imageUpload(Request $request)
    {
        $userid = Auth::guard('api')->user()->id;
        $avatarfile = file_get_contents($request->file);
        $filename = 'users/'.'IdCard'.$userid.'housekeeping'.uniqid().'.png';
        Storage::disk('upyun')->write($filename, $avatarfile);
        $userImage=config('filesystems.disks.upyun.protocol').'://'.config('filesystems.disks.upyun.domain').'/'.$filename;
        // 更新用户数据
        return $userImage;
    }
}
