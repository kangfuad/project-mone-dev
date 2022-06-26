<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Helpers\UtilFunction;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware([
            'auth',
            // 'verified'
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $GET_MENU = new UtilFunction();
        $menu = $GET_MENU->GET_MENU();
        // dd($menu);
        $passing = [
            'title' => 'Beranda',
            'title-page' => 'Halaman Beranda'
        ];
        return view('dashboard',['passing' => $passing]);
    }
}
