<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Profession;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*DB::table('professions')->insert([
            'title'=>'Desarrollador Backend',
        ]);*/
        Profession::create([
            'title'=>'Desarrollador Frontend',
        ]);
        Profession::create([
            'title'=>'Desarrollador Backend',
        ]);
        Profession::create([
            'title'=>'Desarrollador Web',
        ]);
        factory(Profession::class, 17)->create();
    }
}
