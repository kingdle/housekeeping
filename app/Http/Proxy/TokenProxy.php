<?php
namespace App\Http\Proxy;
use App\User;

class TokenProxy {
    protected $http;
    /**
     * TokenProxy constructor.
     * @param $http
     */
    public function __construct(\GuzzleHttp\Client $http)
    {
        $this->http = $http;
    }
    public function login($phone, $password)
    {
        if (auth()->attempt(['phone' => $phone, 'password' => $password,'is_active'=>'1'])) {
            return $this->proxy('password', [
                'username' => $phone,
                'password' => $password,
                'scope'    => '',
            ]);
        }
        $is_phone = User::where('phone', $phone)->first();
        if(!$is_phone){
            return response()->json([
                'status'  => false,
                'message' => '手机号未注册或密码错误',
            ], 401);
        }
        if($is_phone->is_active == 0){
            return response()->json([
                'status'  => false,
                'message' => '商家用户，请通过微信搜索"温馨大姐"小程序登录',
            ], 402);
        }
        return response()->json([
            'status'  => false,
            'message' => '用户名或密码不正确',
        ], 421);
    }
    public function refresh()
    {
        $refreshToken = request()->cookie('refreshToken');
        return $this->proxy('refresh_token', [
            'refresh_token' => $refreshToken,
        ]);
    }
    public function logout()
    {
        $user = auth()->guard('api')->user();
        if (is_null($user)) {
            app('cookie')->queue(app('cookie')->forget('refreshToken'));
            return response()->json([
                'message' => 'Logout!',
            ], 204);
        }
        $accessToken = $user->token();
        app('db')->table('oauth_refresh_tokens')
            ->where('access_token_id', $accessToken->id)
            ->update([
                'revoked' => true,
            ]);
        app('cookie')->queue(app('cookie')->forget('refreshToken'));
        $accessToken->revoke();
        return response()->json([
            'message' => 'Logout!',
        ], 204);
    }
    public function proxy($grantType, array $data = [])
    {
        $data = array_merge($data, [
            'client_id'     => env('PASSPORT_CLIENT_ID'),
            'client_secret' => env('PASSPORT_CLIENT_SECRET'),
            'grant_type'    => $grantType,
        ]);
        $url = env('APP_URL').'/oauth/token';
        $response = $this->http->post($url, [
            'form_params' => $data,
        ]);
        $token = json_decode((string)$response->getBody(), true);
        return response()->json([
            'token'      => $token['access_token'],
            'auth_id'    => md5($token['refresh_token']),
            'expires_in' => $token['expires_in'],
        ])->cookie('refreshToken', $token['refresh_token'], 144000, null, null, false, true);
    }
}
