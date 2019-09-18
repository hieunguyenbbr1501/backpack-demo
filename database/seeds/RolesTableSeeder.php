<?php

use Illuminate\Database\Seeder;
use App\Models\BackpackUser;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        if(DB::table('roles')->where('name','admin')->count()==0){
            DB::table('roles')->insert([
                'name' => 'admin',
                'guard_name' => 'web'
            ]);

        }
        DB::table('roles')->insert([
            'name'=>'backend',
            'guard_name' => 'web'
        ]);
        DB::table('model_has_roles')->insert([
            'role_id' => 1,
            'model_type' => 'App\Models\BackpackUser',
            'model_id' => 1
        ]);
    }
}
