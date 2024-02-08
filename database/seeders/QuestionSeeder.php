<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = array(
            array('question' => 'Bagaimana solusi yg kami berikan?','type'=>'radio','created_at' =>date('Y-m-d h:i:s'),'updated_at' =>date('Y-m-d h:i:s')),
            array('question' => 'Bagaimana kecepatan layanan kami?','type'=>'radio','created_at' =>date('Y-m-d h:i:s'),'updated_at' =>date('Y-m-d h:i:s')),
            array('question' => 'Bagaimana keramahan staff kami?','type'=>'radio','created_at' =>date('Y-m-d h:i:s'),'updated_at' =>date('Y-m-d h:i:s')),
            array('question' => 'Bagaimana pengetahuan produk staff kami?','type'=>'radio','created_at' =>date('Y-m-d h:i:s'),'updated_at' =>date('Y-m-d h:i:s')),
          );
        DB::table('question')->insert($roles);
    }
}
