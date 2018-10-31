<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    $user = $request->user();
    return new \App\Http\Resources\User($user);
});
Route::middleware('auth:api')->get('/shop', function (Request $request) {
    $user = $request->user();
    $shop = \App\Shop::where('user_id', $user->id)->get();
    return $shop[0];
});
Route::get('/girls','GirlsController@index');
Route::get('/girls/{girl}','GirlsController@show');

Route::post('/register', 'Auth\RegisterController@register');
Route::post('/login', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@logout')->middleware('auth:api');
Route::post('/token/refresh', 'Auth\LoginController@refresh');

//Route::post('/user/profile/update', 'UsersController@update')->middleware('auth:api');
//Route::post('/user/password/update', 'PasswordController@update')->middleware('auth:api');
//Route::post('/user/shop/update', 'ShopsController@update')->middleware('auth:api');
//Route::post('/user/seed/update', 'SeedsController@update')->middleware('auth:api');

//passport部分
Route::group(['prefix' => '/v1', 'middleware' => 'cors'], function () {
//    Route::resource('/messages', 'MessagesController')->middleware('auth:api');
    Route::resource('/girls', 'GirlsController')->middleware('auth:api');
    Route::get('/girl/queryByProductId/{id}','GirlsController@queryByProductId')->middleware('auth:api');
    Route::post('/girl/updateEdit', 'GirlsController@updateEdit')->middleware('auth:api');
    Route::get('/girl/examineIndex', 'GirlsController@examineIndex')->middleware('auth:api');
    Route::post('/girl/distanceQuery','GirlsController@distanceQuery')->middleware('auth:api');
    //上传图片
    Route::post('/girl/imageUpload','GirlsController@imageUpload')->middleware('auth:api');

    //users用户
    Route::resource('/users', 'UsersController')->middleware('auth:api');
    //上传图片
    Route::post('/imageUpload','UsersController@imageUpload')->middleware('auth:api');
    //products项目分类
    Route::resource('/products', 'ProductsController');
    //trains报名表
    Route::resource('/trains', 'TrainsController')->middleware('auth:api');
    Route::post('/train/isPay', 'TrainsController@isPay')->middleware('auth:api');
    Route::post('/train/isPhone', 'TrainsController@isPhone')->middleware('auth:api');
    Route::get('/train/queryTrain/{id}', 'TrainsController@queryTrain')->middleware('auth:api');
    Route::get('/train/queryByCycleId/{id}', 'TrainsController@queryByCycleId')->middleware('auth:api');


    //付款表
    Route::resource('/payments', 'PaymentsController')->middleware('auth:api');
    //报名分类
    Route::get('/product/trainList', 'ProductsController@trainList');
    //configs控制信息
    Route::resource('/configs', 'ConfigsController');
    //登录
    Route::post('/login', 'UsersController@weapplogin');

    Route::post('/weappupdate','UsersController@weappupdate')->middleware('auth:api');
    Route::post('/getPhone','UsersController@getPhone')->middleware('auth:api');
    Route::post('/getOpenid','UsersController@getOpenid');
    Route::post('/userPhoneUpdate','UsersController@userPhoneUpdate')->middleware('auth:api');

    Route::post('/girls/admission','GirlsController@admission')->middleware('auth:api');

    Route::resource('/cycles', 'CyclesController');


    //orders订单查询
    Route::resource('/orders', 'OrdersController')->middleware('auth:api');
    Route::post('/order/queryByStatus', 'OrdersController@queryByStatus')->middleware('auth:api');
    Route::post('/order/queryByCall', 'OrdersController@queryByCall')->middleware('auth:api');
    Route::post('/order/payment', 'OrdersController@payment')->middleware('auth:api');
    Route::post('/order/updateFee', 'OrdersController@updateFee')->middleware('auth:api');
    Route::post('/order/isPay', 'OrdersController@isPay')->middleware('auth:api');

    Route::post('/orders-list-size', 'OrdersController@listSize')->middleware('auth:api');
    Route::post('/orders-list-query', 'OrdersController@queryList')->middleware('auth:api');
    Route::get('/orders-query-phone', 'OrdersController@queryPhone')->middleware('auth:api');
    Route::get('/orders-query-address', 'OrdersController@queryAddress')->middleware('auth:api');
    Route::post('/orders-list-result', 'OrdersController@queryResult')->middleware('auth:api');
    Route::get('/buyerList', 'OrdersController@buyerList')->middleware('auth:api');
    Route::post('/orders/pastList', 'OrdersController@pastList')->middleware('auth:api');
    Route::post('/orders/weBuyerList', 'OrdersController@weBuyerList')->middleware('auth:api');
    Route::post('/orders/buyerCreate', 'OrdersController@buyerCreate')->middleware('auth:api');
    Route::post('/orders/sellerCreate', 'OrdersController@sellerCreate')->middleware('auth:api');
    Route::post('/orders/weStore', 'OrdersController@weStore')->middleware('auth:api');
    Route::post('/orders/weOrderUpdate', 'OrdersController@weOrderUpdate')->middleware('auth:api');
    Route::post('/orders/buyerConfirm', 'OrdersController@buyerConfirm')->middleware('auth:api');
    Route::post('/orders/sellerTransport', 'OrdersController@sellerTransport')->middleware('auth:api');
    Route::post('/orders/updateState', 'OrdersController@updateState')->middleware('auth:api');
    Route::post('/orders/updatePayment', 'OrdersController@updatePayment')->middleware('auth:api');
    Route::post('/orders/updateOrder', 'OrdersController@updateOrder')->middleware('auth:api');
    Route::post('/orders/updateLocation', 'OrdersController@updateLocation')->middleware('auth:api');
    Route::post('/orders/weDestroy', 'OrdersController@weDestroy')->middleware('auth:api');

    Route::get('/order/listSeller', 'OrdersController@listSeller')->middleware('auth:api');
    Route::get('/order/listState', 'OrdersController@listState')->middleware('auth:api');
    Route::get('/order/listPayment', 'OrdersController@listPayment')->middleware('auth:api');

});

//dingo部分
$api = app('Dingo\Api\Routing\Router');

$api->version('v2', [
    'namespace' => 'App\Http\Controllers\Api'
], function ($api) {
    $api->group([
        'middleware' => 'api.throttle',
        'limit' => config('api.rate_limits.sign.limit'),
        'expires' => config('api.rate_limits.sign.expires'),
    ], function ($api) {
        $api->post('v2/weappLogin', 'AuthorizationsController@weappLogin');
        $api->post('v2/weappRegister', 'AuthorizationsController@weappRegister');
        $api->post('v2/weappShopRegister', 'AuthorizationsController@weappShopRegister');
        $api->post('v2/logout', 'AuthorizationsController@destroy');
        $api->post('v2/token/refresh', 'AuthorizationsController@update');


    });
});

