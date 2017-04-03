<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SonghaoController extends Controller
{
   public function index(){
     return view('front.index');
   }
   
   public function indexc(){
       echo'高松豪';
   }
}
