<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ApiResponses;


class Authcontroller extends Controller
{
    //
    use ApiResponses;
    public function login(){
        return $this -> ok ("hi , yusuf welcome to your api");
    }
}
  