<?php

namespace Database\Seeders;

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
        DB::table('admin_users')->insert([
            [
                'name' => 'Admin',
                'email' => 'adminqfx@gmail.com',
                'mobile_no' => '95555150122',
                'user_name' => 'adminqfx',
                'password' => password_hash('123456', PASSWORD_BCRYPT),
            ]
        ]);
    }
}
