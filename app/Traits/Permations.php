<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait Permations
{
    public function permation($parent,$child)
    {
        $userPer= Auth::guard('sanctum')->user()->permations;   
        // dd($userPer['sector']['create']);
        if(empty($userPer)){
            return response()->json('access denied',401);
        }
        if (isset($userPer[$parent][$child]) && $userPer[$parent][$child] == 0){
            return response()->json('access denied',401);
        }
        return true;
     }
}
