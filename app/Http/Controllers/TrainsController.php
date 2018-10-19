<?php

namespace App\Http\Controllers;

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
    public function store(Request $request){
        $userId = Auth::guard('api')->user()->id;
        $train=Train::create([
            'user_id' => $userId,
            'product_id' => request('product_id', ''),
            'title' => request('title', ''),
            'period' => request('period', ''),
            'username' => request('username', ''),
            'id_card' => request('id_card', ''),
            'id_card_front' => request('id_card_front', ''),
            'id_card_back' => request('id_card_back', ''),
            'real_head' => request('real_head', ''),
            'price' => request('price', '0'),
            'address' => request('address', ''),
            'phone' => request('phone', ''),
            'content' => request('content', ''),
            'is_pay' => request('is_pay', 'F'),
        ]);
        $user = User::find($userId);
        $attributes['username'] = request('username', '');
        $attributes['id_card'] = request('id_card', '');
        $attributes['is_active'] = '2';
        $user->update($attributes);
        return response()->json([
            'train'=>$train,
            'user'=>$user
        ], 200);
    }
    public function isPay(Request $request){
        $userId = Auth::guard('api')->user()->id;
        $train=Train::find(request('id', ''));
        $attributes['is_pay'] = 'T';
        $train->update($attributes);
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
}
