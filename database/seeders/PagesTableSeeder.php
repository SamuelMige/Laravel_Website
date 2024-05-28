<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pages')->insert([
            'user' => 'Samuel Mige',
            'introduction' => 'This is a description text that appears on the left side of the parallax background. It gives an overview of the content or purpose of the website.',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'logo' => 'akuganteng.jpg',
            'background' => 'tst.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
