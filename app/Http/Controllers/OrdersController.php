<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderCollection;
use App\Order;
use Auth;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index(){
        $userId = Auth::guard('api')->user()->id;
        $orders=Order::with('user')->where('user_id',$userId)->where("is_hidden",'F')->orderBy('id', 'desc')->paginate(9);
        return new OrderCollection($orders);
    }
    public function queryByStatus(Request $request){
        $userId = Auth::guard('api')->user()->id;
        $orders=Order::with('user')->where('user_id',$userId)->where("status",$request->status)->where("is_hidden",'F')->orderBy('id', 'desc')->paginate(9);
        return new OrderCollection($orders);
    }
    public function queryByCall(Request $request){
        $isadmin = Auth::guard('api')->user()->is_admin;
        if($isadmin=='1'){
            $orders=Order::with('user')->where("is_call",$request->is_call)->where("is_hidden",'F')->orderBy('id', 'desc')->paginate(9);
            return new OrderCollection($orders);
        }else{
            $data['status'] = false;
            $data['status_code'] = '502';
            $data['msg'] = '您不是管理员';
            return json_encode($data);
        }

    }
    public function show($id){
        return Order::with('user')->where("user_id",$id)->first();
    }
    public function store(Request $request){
        $userId = Auth::guard('api')->user()->id;
        $order=Order::create([
            'user_id' => $userId,
            'to_user_id' => request('to_user_id', '0'),
            'product_id' => request('product_id', ''),
            'price' => request('price', '0'),
            'city' => request('city', ''),
            'address' => request('address', ''),
            'content' => request('content', null),
            'day_at' => request('day_at', ''),
            'status_mean' => '待电话确认',
        ]);

        return response()->json([
            'data'=>$order,
        ], 200);
    }
    public function destroy($id){
        $order=Order::find($id);
        $attributes['is_hidden'] = 'T';
        $order->update($attributes);
    }
}
