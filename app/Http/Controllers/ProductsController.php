<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(){
        return Product::where("is_hidden",'F')->get();
    }
    public function trainList(){
        return Product::where("status_type",'0')->get();
    }
    public function show(Product $product){
        return $product;
    }
}
