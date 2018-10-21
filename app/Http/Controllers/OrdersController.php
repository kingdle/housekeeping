<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderCollection;
use App\Order;
use App\Payment;
use Auth;
use Illuminate\Http\Request;
use function EasyWeChat\Kernel\Support\generate_sign;
use Yansongda\LaravelPay\Facades\Pay;

class OrdersController extends Controller
{
    public function index(){
        $userId = Auth::guard('api')->user()->id;
        $orders=Order::with('user','product')->where('user_id',$userId)->where("is_hidden",'F')->orderBy('id', 'desc')->paginate(9);
        return new OrderCollection($orders);
    }
    public function queryByStatus(Request $request){
        $userId = Auth::guard('api')->user()->id;
        $orders=Order::with('user','product')->where('user_id',$userId)->where("status",$request->status)->where("is_hidden",'F')->orderBy('id', 'desc')->paginate(9);
        return new OrderCollection($orders);
    }
    public function queryByCall(Request $request){
        $isadmin = Auth::guard('api')->user()->is_admin;
        if($isadmin=='1'){
            $orders=Order::with('user','product')->where("is_call",$request->is_call)->where("is_hidden",'F')->orderBy('id', 'desc')->paginate(9);
            return new OrderCollection($orders);
        }else{
            $data['status'] = false;
            $data['status_code'] = '502';
            $data['msg'] = '您不是管理员';
            return json_encode($data);
        }

    }
    public function show($id){
        return Order::with('user','product')->where("user_id",$id)->first();
    }
    public function store(Request $request){
        $userId = Auth::guard('api')->user()->id;
        $order=Order::create([
            'user_id' => $userId,
            'to_user_id' => request('to_user_id', '0'),
            'product_id' => request('product_id', ''),
            'price' => request('price', '0'),
            'phone' => request('phone', ''),
            'address' => request('address', ''),
            'address_name' => request('address_name', ''),
            'latitude' => request('latitude', ''),
            'longitude' => request('longitude', ''),
            'address_full' => request('address_full', ''),
            'content' => request('content', null),
            'day_at' => request('day_at', ''),
            'status_mean' => '待电话确认',
        ]);

        return response()->json([
            'data'=>$order,
        ], 200);
    }
    public function updateFee(Request $request){
        $order=Order::find(request('id', ''));
        $attributes['fee'] = request('fee', '');
        $attributes['is_call'] = 'T';
        $attributes['status_mean'] = "已电话确认";
        $attributes['service_id'] = Auth::guard('api')->user()->id;
        $attributes['service_at'] = now();
        $order->update($attributes);
    }
    public function payment(Request $request){
        $code = request('code', '1');
        $miniProgram = \EasyWeChat::miniProgram();
        $data = $miniProgram->auth->session($code);
        if (isset($data['errcode'])) {
            return $this->response->errorUnauthorized('code已过期或不正确');
        }
        $weappOpenid = $data['openid'];
        $order=Order::where("id",request('id', ''))->first();
        $order = [
            'out_trade_no' => time(),
            'body' => request('body', '温馨大姐服务收费'),
            'total_fee' => round($order['fee']*100),
            'trade_type'   => 'JSAPI',  // 必须为JSAPI
            'openid' => $weappOpenid,
        ];
        $result = Pay::wechat()->miniapp($order);

        // 如果成功生成统一下单的订单，那么进行二次签名
        if ($result['return_code'] === 'SUCCESS') {
            // 二次签名的参数必须与下面相同
            $params = [
                'appId'     => env('WECHAT_MINI_PROGRAM_APPID', ''),
                'timeStamp' => time(),
                'nonceStr'  => $result['nonce_str'],
                'package'   => 'prepay_id=' . $result['prepay_id'],
                'signType'  => 'MD5',
            ];

            // config('wechat.payment.default.key')为商户的key
            $params['paySign'] = generate_sign($params, config('wechat.payment.default.key'));

            return $params;
        } else {
            return $result;
        }
    }
    public function isPay(Request $request){
        $order=Order::with('user','product')->find(request('id', ''));
        $attributes['is_pay'] = 'T';
        $attributes['status'] = '1';
        $attributes['pay_at'] = now();
        $order->update($attributes);
        $payment=Payment::create([
            'user_id' => $order['user_id'],
            'customer' => $order['user']['nickname'],
            'type_id' => $order['product_id'],
            'goods_name' => $order['product']['title'],
            'number_id' => uniqid(),
            'total_fee' => $order['fee'],
            'quantity' => '1',
            'times_at' => now(),
        ]);
        return $order;
    }
    public function destroy($id){
        $order=Order::find($id);
        $attributes['is_hidden'] = 'T';
        $order->update($attributes);
    }
}
