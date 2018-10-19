<?php

namespace App\Http\Controllers;

use App\Girl;
use App\Http\Resources\GirlCollection;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GirlsController extends Controller
{
    public function index(){
        $girls=Girl::with('user','product')->where("is_active",'1')->where("is_hidden",'F')->orderBy('id', 'desc')->paginate(9);
        return new GirlCollection($girls);
    }
    public function queryByProductId($id){
        $girls=Girl::with('user','product')->where("product_id",$id)->where("is_active",'1')->where("is_hidden",'F')->orderBy('id', 'desc')->paginate(9);
        return new GirlCollection($girls);
    }
    public function examineIndex(){
        $girls=Girl::with('user')->where("is_hidden",'F')->orderBy('is_active', 'asc')->paginate(9);
        return new GirlCollection($girls);
    }
    public function show($id){
        $girl=Girl::with('user','product')->where("user_id",$id)->first();
        $user= User::find($id);
        $user->increment('click_count');
        return $girl;
    }
    public function admission(Request $request){
        $userId = Auth::guard('api')->user()->id;
            $no = request('id_card', '');
            $year = substr($no, 6, 4);
            $monthDay = substr($no, 10, 4);
            $age = date('Y') - $year;
            if ($monthDay > date('md')) {
                $age--;
            }
        $girl=Girl::create([
            'user_id' => $userId,
            'product_id' => request('product_id', ''),
            'number_id' => uniqid(),
            'username' => request('username', ''),
            'id_card' => request('id_card', ''),
            'id_card_front' => request('id_card_front', ''),
            'id_card_back' => request('id_card_back', ''),
            'real_head' => request('real_head', ''),
            'age' => $age,
            'native_place' => request('native_place', ''),
            'education' => request('education', ''),
            'health_card' => request('health_card', ''),
            'level' => request('level', ''),
            'price' => request('price', '0'),
            'service_times' => request('service_times', ''),
            'experience' => request('experience', ''),
        ]);
        $user = User::find($userId);
        $attributes['is_active'] = '1';
        $user->update($attributes);
        return response()->json([
            'data'=>$girl,
            'user'=>$user
        ], 200);
    }
    public function distance(Request $request)
    {
        if($request->latitude){
            $lat = $request->latitude;
        }else{
            $lat ='36.826762';
        }
        if($request->longitude){
            $lng = $request->longitude;
        }else{
            $lng = '118.913778';
        }
        $girls = Girl::where("is_hidden",'!=','T')->where("is_service",'!=','T')
            ->selectRaw('id,summary,title,avatar,province,cityInfo,address,villageInfo,code,longitude,latitude,dynamic_count,pic_count,acos(cos(' . $lat . '*pi()/180 )*cos(latitude*pi()/180)*cos(' . $lng . '*pi()/180 -longitude*pi()/180)+sin(' . $lat . '*pi()/180 )*sin(latitude*pi()/180))*6370996.81  as distance')  //使用原生sql
            ->orderby("distance","asc")->paginate(20);
        return $girls;
    }
    public function updateEdit(Request $request)
    {
        $girl = Girl::where('user_id',$request->id);
        $active=$girl->first();
        if($active['is_active']=='1'){
            $data['status'] = false;
            $data['status_code'] = '502';
            $data['msg'] = '已通过审核，不能修改信息';
            return json_encode($data);
        }
        if($request->username){
            $attributes['username'] = $request->username;
        }
        if($request->id_card){
            $attributes['id_card'] = $request->id_card;
        }
        if($request->native_place){
            $attributes['native_place'] = $request->native_place;
        }
        if($request->education_id){
            $attributes['education_id'] = $request->education_id;
        }
        if($request->education){
            $attributes['education'] = $request->education;
        }
        if($request->health_card){
            $attributes['health_card'] = $request->health_card;
        }
        if($request->product_id){
            $attributes['product_id'] = $request->product_id;
        }
        if($request->level){
            $attributes['level'] = $request->level;
        }
        if($request->price){
            $attributes['price'] = $request->price;
        }
        if($request->service_times){
            $attributes['service_times'] = $request->service_times;
        }
        if($request->experience){
            $attributes['experience'] = $request->experience;
        }
        if($request->is_active){
            $attributes['is_active'] = $request->is_active;
        }
        $attributes['updated_at'] = now();
        $success = $girl->update($attributes);
        if ($success) {
            $data['status'] = true;
            $data['status_code'] = '200';
            $data['msg'] = $girl;
            return json_encode($data);
        } else {
            $data['status'] = false;
            $data['status_code'] = '502';
            $data['msg'] = '系统繁忙，请售后再试';
            return json_encode($data);
        }
    }
    public function imageUpload(Request $request)
    {
        $girl = Girl::where('user_id',$request->id);
        $active=$girl->first();
        if($active['is_active']=='1'){
            $data['status'] = false;
            $data['status_code'] = '502';
            $data['msg'] = '已通过审核，不能修改信息';
            return json_encode($data);
        }
        $userid = $request->id;
        $avatarfile = file_get_contents($request->file);
        $filename = 'users/'.'IdCard'.$userid.'housekeeping'.uniqid().'.png';
        Storage::disk('upyun')->write($filename, $avatarfile);
        $userImage=config('filesystems.disks.upyun.protocol').'://'.config('filesystems.disks.upyun.domain').'/'.$filename;
        // 更新用户数据


        if($request->id_card_front){
            $attributes['id_card_front'] = $userImage;
        }
        if($request->id_card_back){
            $attributes['id_card_back'] = $userImage;
        }
        if($request->real_head){
            $attributes['real_head'] = $userImage;
        }
        $attributes['updated_at'] = now();
        $girl->update($attributes);
        return $userImage;

    }
}
