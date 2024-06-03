<?php

use Illuminate\Database\Seeder;

class player extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('player')->insert([
            'name' => Str::random(10), 
            'national_team' => Str::random(10), 
            'position' => Str::random(10), 
            'answer' => Str::random(10),  
        ]);
    }

 
}
