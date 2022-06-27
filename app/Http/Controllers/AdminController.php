<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\UtilFunction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

// MODELS
use App\Models\MasterSubMenu;
use App\Models\User;
// END MODELS


class AdminController extends Controller
{
    public function index()
    {
        $GET_MENU = new UtilFunction();
        $menu = $GET_MENU->GET_MENU();
        $menu_head = "ADMIN MENU";
        $passing = [
            'title' => 'Beranda',
            'title-page' => 'Halaman Beranda',
            'menu' => $menu,
            'menu_head' => $menu_head
        ];
        return view('PAGES.ADMIN.index', ['passing' => $passing]);
    }


    // MENU MANAJEMENt

    public function menu_manajemen()
    {
        $GET_MENU = new UtilFunction();
        $menu = $GET_MENU->GET_MENU();
        $menu_head = "ADMIN MENU";
        $table_menu = MasterSubMenu::with(['role'])->OrderBy('id', 'desc')->get();
        $passing = [
            'title' => 'Menu Manajemen',
            'title-page' => 'Halaman Menu Manajemen',
            'menu' => $menu,
            'menu_head' => $menu_head,
            'table_menu' => $table_menu
        ];
        return view('PAGES.ADMIN.menu-manajement', ['passing' => $passing]);
    }

    public function tambah_menu_manajemen(Request $req)
    {

        $menu = new MasterSubMenu();

        $menu->role_id = trim($req->role);
        $menu->nama_sub_menu = trim($req->nama);
        $menu->slug_sub_menu = Str::of($req->nama)->slug('-');
        $menu->path_menu = trim($req->path);
        $menu->icon_sub_menu = trim($req->icon);
        $menu->created_by = Auth::user()->id;

        if ($menu->save()) {
            return redirect('/admin/menu-manajemen')->with('berhasil', 'Menu baru berhasil ditambahkan');
        } else {
            return redirect('/admin/menu-manajemen')->with('error', 'Menu baru gagal ditambahkan');
        }
    }

    public function hapus_menu_manajemen(Request $req)
    {

        $menu = MasterSubMenu::where('slug_sub_menu', $req->dSlug)
            ->update(['is_active' => 0]);

        if ($menu) {
            return redirect('/admin/menu-manajemen')->with('berhasil', 'Menu baru berhasil hapus');
        } else {
            return redirect('/admin/menu-manajemen')->with('error', 'Menu baru gagal hapus');
        }
    }

    // END MENU MANAJEMENt


    // USERS MANAJEMENT
    public function user_manajemen()
    {
        $GET_MENU = new UtilFunction();
        $menu = $GET_MENU->GET_MENU();
        $menu_head = "ADMIN MENU";
        $table_user = User::with(['role'])->OrderBy('id', 'desc')->get();
        $passing = [
            'title' => 'Users Manajemen',
            'title-page' => 'Halaman Users Manajemen',
            'menu' => $menu,
            'menu_head' => $menu_head,
            'table_user' => $table_user
        ];
        return view('PAGES.ADMIN.user-manajement', ['passing' => $passing]);
    }

    public function tambah_user_manajemen(Request $req)
    {

        $menu = new User();

        $menu->name = trim($req->nama);
        $menu->role_id = trim($req->role);
        $menu->email = trim($req->email);
        $menu->password = trim(Hash::make($req['password']));

        if ($menu->save()) {
            return redirect('/admin/user-manajemen')->with('berhasil', 'User baru berhasil ditambahkan');
        } else {
            return redirect('/admin/user-manajemen')->with('error', 'User baru gagal ditambahkan');
        }
    }

    // END USER MANAJEMENT

    public function icon()
    {
        $GET_MENU = new UtilFunction();
        $menu = $GET_MENU->GET_MENU();
        $menu_head = "ADMIN MENU";
        $passing = [
            'title' => 'Beranda',
            'title-page' => 'Halaman Beranda',
            'menu' => $menu,
            'menu_head' => $menu_head
        ];
        return view('PAGES.ADMIN.icon', ['passing' => $passing]);
    }
}
