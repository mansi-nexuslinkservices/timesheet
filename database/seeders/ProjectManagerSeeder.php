<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ProjectManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = array(
            [
                'name' => "Vijay Dabhi",
                'email' => "vijay@nexuslinkservices.com",
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => "Rinkal Kikani",
                'email' => "rinkal.k@nexuslinkservices.in",
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => "Ankit Patel",
                'email' => "ankit@nexuslinkservices.in",
                'created_at' => date('Y-m-d H:i:s'),
            ]
        );

        DB::table('projectmanagers')->insert($data);
    }
}
