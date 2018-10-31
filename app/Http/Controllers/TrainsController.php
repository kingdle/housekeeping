<?php

namespace App\Http\Controllers;

use App\Cycle;
use App\Girl;
use App\Http\Resources\TrainCollection;
use App\Payment;
use App\Train;
use App\User;
use Auth;
use Illuminate\Http\Request;

class TrainsController extends Controller
{
    public function index(){
        $trains=Train::with('user')->where("is_hidden",'F')->orderBy('id', 'desc')->paginate(9);
        return new TrainCollection($trains);
    }
    public function show($id){
        $train=Train::with('user')->where("user_id",$id)->first();
        return $train;
    }
    public function queryTrain($id){
        $train=Train::with('product','user')->where("user_id",$id)->where("is_hidden",'F')->orderBy('id', 'desc')->get();
        if($train->isEmpty()){
            $data['status'] = false;
            $data['status_code'] = '502';
            $data['train'] = '';
            return json_encode($data);
        }else{
            return new TrainCollection($train);
        }
    }
    public function queryByCycleId($id){
        $train=Train::with('user','product')->where("cycle_id",$id)->where("is_hidden",'F')->orderBy('id', 'desc')->paginate(9);
        if($train->isEmpty()){
            $data['status'] = false;
            $data['status_code'] = '502';
            $data['train'] = '';
            return json_encode($data);
        }else{
            return new \App\Http\Resources\Train($train);
        }
    }
    public function store(Request $request){
        $userId = Auth::guard('api')->user()->id;
        $no = request('id_card', '');
        $year = substr($no, 6, 4);
        $monthDay = substr($no, 10, 4);
        $age = date('Y') - $year;
        if ($monthDay > date('md')) {
            $age--;
        }
        $train=Train::create([
            'user_id' => $userId,
            'product_id' => request('product_id', ''),
            'cycle_id' => request('cycle_id', ''),
            'cycle_at' => request('cycle_at', ''),
            'title' => request('title', ''),
            'period' => request('period', ''),
            'username' => request('username', ''),
            'id_card' => request('id_card', ''),
            'id_card_front' => request('id_card_front', ''),
            'id_card_back' => request('id_card_back', ''),
            'real_head' => request('real_head', ''),
            'price' => request('price', '0'),
            'address' => request('address', ''),
            'address_name' => request('address_name', ''),
            'latitude' => request('latitude', ''),
            'longitude' => request('longitude', ''),
            'phone' => request('phone', ''),
            'content' => request('content', ''),
            'is_pay' => request('is_pay', 'F'),
        ]);
        $isgirl=Girl::where('user_id',$userId)->get();
        if($isgirl->isEmpty()){
            $girl=Girl::create([
                'user_id' => $userId,
                'product_id' => request('product_id', ''),
                'number_id' =>uniqid(),
                'username' => request('username', ''),
                'period' => request('period', ''),
                'id_card' => request('id_card', ''),
                'id_card_front' => request('id_card_front', ''),
                'id_card_back' => request('id_card_back', ''),
                'real_head' => request('real_head', ''),
                'age' => $age,
                'address' => request('address', ''),
                'address_name' => request('address_name', ''),
                'latitude' => request('latitude', ''),
                'longitude' => request('longitude', ''),
                'experience'=> request('experience', ''),
            ]);
        }
        $user = User::find($userId);
        $attributes['username'] = request('username', '');
        $attributes['id_card'] = request('id_card', '');
        $attributes['age'] = $age;
        $attributes['is_active'] = '1';
        $user->update($attributes);
        return response()->json([
            'train'=>$train,
            'user'=>$user
        ], 200);
    }
    public function isPay(Request $request){
        $userId = Auth::guard('api')->user()->id;
        $train=Train::find(request('id', ''));
        if($request->pay_type){
            $attributes['pay_type'] = '1';
        }
        $attributes['is_pay'] = 'T';
        $train->update($attributes);
        Cycle::where('id', $train['cycle_id'])->increment('enrolments_count');//报名付费人数加1
        $payment=Payment::create([
            'user_id' => $userId,
            'type_id' => $train['product_id'],
            'customer' => $train['username'],
            'goods_name' => $train['title'],
            'number_id' => uniqid(),
            'total_fee' => $train['price'],
            'quantity' => $train['period'],
            'times_at' => now(),
        ]);
        return $train;
    }
    public function isPhone(Request $request){
        $train=Train::find(request('id', ''));
        if($request->is_phone == true){
            $attributes['is_phone'] = 'T';
        }else{
            $attributes['is_phone'] = 'F';
        }
        $train->update($attributes);
        return $train;
    }
}
