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
            array('question' => 'Bagaimana penampilan petugas yang melayani ?','type'=>'radio','created_at' =>date('Y-m-d h:i:s'),'updated_at' =>date('Y-m-d h:i:s')),
            array('question' => 'Bagaimana kepuasan nasabah terhadap pelayanan kami ?','type'=>'radio','created_at' =>date('Y-m-d h:i:s'),'updated_at' =>date('Y-m-d h:i:s')),
            array('question' => 'Bagaimana kualitas penyambutan oleh security cabang kami ?','type'=>'radio','created_at' =>date('Y-m-d h:i:s'),'updated_at' =>date('Y-m-d h:i:s')),
            array('question' => 'Bagaimana keramahan petugas yang melayani ?','type'=>'radio','created_at' =>date('Y-m-d h:i:s'),'updated_at' =>date('Y-m-d h:i:s')),
            array('question' => 'Bagaimana pengetahuan petugas yang melayani ?','type'=>'radio','created_at' =>date('Y-m-d h:i:s'),'updated_at' =>date('Y-m-d h:i:s')),
            array('question' => 'Bagaimana ruang banking hall ?','type'=>'radio','created_at' =>date('Y-m-d h:i:s'),'updated_at' =>date('Y-m-d h:i:s')),
          );
        DB::table('question')->insert($roles);
    }
}
