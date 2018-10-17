<?php

namespace App\Http\Controllers;

use App\Config;
use Illuminate\Http\Request;

class ConfigsController extends Controller
{
    public function index(){
        return Config::find('1');
    }

    public function show(Girl $girl){
        return $girl;
    }
}
