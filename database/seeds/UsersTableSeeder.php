<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('users')->where('email', 'admin@example.com')->count() == 0) {
            DB::table('users')->insert([
                'name'     => 'Demo Admin',
                'email'    => 'admin@example.com',
                'password' => bcrypt('admin'),
                'is_admin' => 1
            ]);
        }
        if (DB::table('users')->where('email', 'backend@example.com')->count() == 0) {
            DB::table('users')->insert([
                'name'     => 'Demo Backend',
                'email'    => 'backend@example.com',
                'password' => bcrypt('backend'),
                'is_admin' => 1
            ]);
        }
        if (DB::table('users')->where('email', 'backend@example.com')->count() == 0) {
            DB::table('users')->insert([
                'name'     => 'Demo User',
                'email'    => 'user@example.com',
                'password' => bcrypt('user'),
                'is_admin' => 0
            ]);
        }
    }
}
