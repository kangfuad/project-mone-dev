<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function index()
    {


        if (Auth::user()) {
            $role = Auth::user()->role_id;
            if (isset($role) == 1) {
                return redirect('/admin');
            } else if (isset($role) == 2) {
                return redirect('/mcc');
            } else if (isset($role) == 3) {
                return redirect('/foreman');
            } else if (isset($role) == 4) {
                return redirect('/warehouse');
            } else {

                $passing = [
                    'title' => 'Masuk',
                ];
                return view('index', ['passing' => $passing]);
            }
        } else {
            $passing = [
                'title' => 'Masuk',
            ];
            return view('index', ['passing' => $passing]);
        }
    }

    public function history_page(){
        $menu_head = "ADMIN MENU"; // dd($menu);
        $passing = [
            'title' => 'History Unit',
            'title-page' => 'Halaman History'
        ];
        return view('PAGES.HISTORY.index', get_defined_vars());
    }
}
