<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class CabangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cabang = array(
            array('id' => '1','nama_cabang' => 'cokroaminoto','created_at' => '2023-10-05 05:46:43','updated_at' => '2023-10-05 05:46:43'),
            array('id' => '2','nama_cabang' => 'scbd','created_at' => '2023-10-05 05:46:52','updated_at' => '2023-10-05 05:46:52')
        );
        DB::table('cabang')->insert($cabang); 
    }
}
