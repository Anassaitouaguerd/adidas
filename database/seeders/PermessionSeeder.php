<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permissions')->insert(
            [
            [
                'permissions' => '/home',
            ],
            [
                'permissions' => '/categories',
            ],
            [
                'permissions' => '/new_category',
            ],
            [
                'permissions' => '/update_category',
            ],
            [
                'permissions' => '/delete_category',
            ],
            ]
        );
    }
}
