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
                'name' => "vishal",
                'email' => "vishal.pethani@nexuslinkservices.in",
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => "Mansi",
                'email' => "mansi.panchal@nexuslinkservices.in",
                'created_at' => date('Y-m-d H:i:s'),
            ]
        );

        DB::table('teamleaders')->insert($data);
    }
}
