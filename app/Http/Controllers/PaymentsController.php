<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function EasyWeChat\Kernel\Support\generate_sign;
use Yansongda\LaravelPay\Facades\Pay;
use Yansongda\Pay\Log;

class PaymentsController extends Controller
{
    public function index(){

    }
    public function store(Request $request){
        $code = request('code', '1');
        $miniProgram = \EasyWeChat::miniProgram();
        $data = $miniProgram->auth->session($code);
        if (isset($data['errcode'])) {
            return $this->response->errorUnauthorized('code已过期或不正确');
        }
        $weappOpenid = $data['openid'];
        $order = [
            'out_trade_no' => time(),
            'body' => request('body', '温馨大姐培训收费'),
            'total_fee' => round(request('total_fee', '1')),
            'trade_type'   => 'JSAPI',  // 必须为JSAPI
            'openid' => $weappOpenid,
        ];
        $result = Pay::wechat()->miniapp($order);

//        $payment = \EasyWeChat::payment(); // 微信支付
//        $result = $payment->order->unify([
//            'body'         => request('body', '温馨大姐培训收费'),
//            'out_trade_no' => uniqid(),
//            'trade_type'   => 'JSAPI',  // 必须为JSAPI
//            'openid'       => $weappOpenid, // 这里的openid为付款人的openid
//            'total_fee'    => request('total_fee', '1'), // 总价
//            'notify_url' => 'https://pay.weixin.qq.com/wxpay/pay.action',
//        ]);
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
}
