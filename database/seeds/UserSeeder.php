<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Profession;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*DB::table('users')->insert([
            'name'=>'Cristian Avila',
            'email'=>'cristian@develhouse.com',
            'password'=>bcrypt('Internet2323'),
            'profession_id'=>DB::table('professions')->whereTitle('Desarrollador backend')->value('id'),
        ]);*/
        $professionId = Profession::whereTitle('Desarrollador backend')->value('id');
        User::create([
            'name'=>'Cristian Avila',
            'email'=>'cristian@develhouse.com',
            'password'=>bcrypt('12345'),
            'profession_id'=> $professionId,
            'is_admin'=>true,
        ]);
        factory(User::class)->create([
            'profession_id'=>$professionId
        ]);
        factory(User::class,50)->create();
    }
}
