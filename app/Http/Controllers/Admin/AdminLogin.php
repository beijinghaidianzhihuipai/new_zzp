<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminLogin extends Controller
{
   public function index(){
       return views('admin.admin');
   }
}
