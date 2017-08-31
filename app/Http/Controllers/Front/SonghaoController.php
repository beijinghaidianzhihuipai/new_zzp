<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SonghaoController extends Controller
{
   public function index(){
     return view('front.front');
   }
   
   public function aaa(){
       $data = '高松豪';
       return view('front.index', $data);
   }
}
