<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('master_roles')->insert(
            [
                'id_role' => 1,
                'nama_role' => 'SUPER ADMIN',
                'slug_role' => 'super-admin',
                'deskripsi_role' => 'SUPER DARI SEGALA SUPER',
                'updated_by' => 1,
                'created_by' => 1
            ],
            [
                'id_role' => 2,
                'nama_role' => 'MCC',
                'slug_role' => 'mcc',
                'deskripsi_role' => 'MCC DEPARTEMENT',
                'updated_by' => 1,
                'created_by' => 1
            ],
            [
                'id_role' => 3,
                'nama_role' => 'FOREMAN',
                'slug_role' => 'foreman',
                'deskripsi_role' => 'FOREMAN DEPARTEMENT',
                'updated_by' => 1,
                'created_by' => 1
            ],
            [
                'id_role' => 4,
                'nama_role' => 'SWAREHOUSE',
                'slug_role' => 'warehouse',
                'deskripsi_role' => 'WAREHOUSE DEPARTEMENT',
                'updated_by' => 1,
                'created_by' => 1
            ]
        );


        DB::table('master_menus')->insert(
            [
                'role_id' => 1,
                'nama_menu' => 'ADMIN MENU',
                'slug_menu' => 'admin-menu',
                'icon_menu' => 'ri-pages-line',
                'updated_by' => 1,
                'created_by' => 1
            ]
        );

        DB::table('master_sub_menus')->insert(
            [
                'role_id' => 1,
                'nama_sub_menu' => 'MENU MANAJEMEN',
                'slug_sub_menu' => 'menu-manajemen',
                'path_menu' => '/admin-menu/menu-manajemen',
                'updated_by' => 1,
                'created_by' => 1
            ]
        );
    }
}
