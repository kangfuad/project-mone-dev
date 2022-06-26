<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

// MODELS
use App\Models\MasterMenu;
use App\Models\MasterSubMenu;
use App\Models\MasterRole;
use App\Models\MasterStatus;
// END MODELS


class UtilFunction
{
    function GET_MENU()
    {
        $role_user = Auth::user()->role_id;

        $menu = MasterSubMenu::where(['role_id'=> $role_user])->OrderBy('nama_sub_menu','ASC')->get();


        return $menu;
    }
}
