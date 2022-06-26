<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        $passing = [
            'title' => 'Masuk',
        ];
        return view('index',['passing' => $passing]);
    }
}
