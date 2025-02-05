<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function data($cd, $ms, $data){
        return response()->json([
            'status'=> $cd,
            'message'=> $ms,
            'data'=> $data
        ]);
    }
}
