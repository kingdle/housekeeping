<?php

namespace App\Http\Controllers;

use App\Train;
use App\User;
use Auth;
use Illuminate\Http\Request;

class TrainsController extends Controller
{
    public function index(){
        $girls=Train::with('user')->where("is_hidden",'F')->orderBy('id', 'desc')->paginate(9);
        return new GirlCollection($girls);
    }
    public function show($id){
        $girl=Train::with('user')->where("user_id",$id)->first();
        $user= User::find($id);
        $user->increment('click_count');
        return $girl;
    }
    public function store(Request $request){
        $userId = Auth::guard('api')->user()->id;
        $girl=Train::create([
            'user_id' => $userId,
            'product_id' => request('product_id', ''),
            'username' => request('username', ''),
            'id_card' => request('id_card', ''),
            'id_card_front' => request('id_card_front', ''),
            'id_card_back' => request('id_card_back', ''),
            'real_head' => request('real_head', ''),
            'price' => request('price', '0'),
            'address' => request('address', ''),
            'content' => request('content', ''),
            'is_pay' => request('is_pay', 'F'),
        ]);
        $user = User::find($userId);
        $attributes['username'] = request('username', '');
        $attributes['id_card'] = request('id_card', '');
        $attributes['is_active'] = '2';
        $user->update($attributes);
        return response()->json([
            'data'=>$girl,
            'user'=>$user
        ], 200);
    }
}
