<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class TeamleaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = array(
            [
                'name' => "Rinkal",
                'email' => "rinkal.k@nexuslinkservices.in",
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => "Ankit",
                'email' => "ankit@nexuslinkservices.in",
                'created_at' => date('Y-m-d H:i:s'),
            ]
        );

        DB::table('teamleaders')->insert($data);
    }
}
