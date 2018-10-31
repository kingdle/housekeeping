<?php

namespace App\Http\Controllers;

use App\Cycle;
use App\Http\Resources\CycleCollection;
use Auth;
use Illuminate\Http\Request;

class CyclesController extends Controller
{
    public function index(){
        $cycles=Cycle::with('product')->where("is_hidden",'F')->orderBy('id', 'desc')->paginate(9);
        return new CycleCollection($cycles);
    }
    public function show($id){
        $cycle=Cycle::with('product')->where("id",$id)->first();
        return new \App\Http\Resources\Cycle($cycle);
    }

    public function store(Request $request){
//        $userId = Auth::guard('api')->user()->id;
        $cycle=Cycle::create([
            'user_id' => request('user_id', ''),
            'product_id' => request('product_id', ''),
            'title' => request('title', ''),
            'price' => request('price', '0'),
            'period' => request('period', '80'),
            'times_at' => request('times_at', ''),
            'times_end' => request('times_end', ''),
            'trains_count' => request('trains_count', ''),
            'enrolments_count' => request('enrolments_count', '0'),
            'longitude' => request('longitude', ''),
            'latitude' => request('latitude', ''),
            'address' => request('address', ''),
            'address_name' => request('address_name', ''),
            'link_man' => request('link_man', ''),
            'phone' => request('phone', ''),
            'remark' => request('remark', ''),
        ]);
        return response()->json([
            'cycle'=>$cycle,
        ], 200);
    }
}
