<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class DetailReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $report_detail = array(
            array('id' => '1','report_id' => '1','question' => 'Bagaimana penampilan petugas yang melayani ?','point' => '6','date' => '2024-01-08','created_at' => '2024-01-08 16:39:52','updated_at' => '2024-01-10 16:39:52'),
            array('id' => '2','report_id' => '1','question' => 'Bagaimana kepuasan nasabah terhadap pelayanan kami ?','point' => '8','date' => '2024-01-08','created_at' => '2024-01-08 00:00:00','updated_at' => '2024-01-10 16:39:52'),
            array('id' => '3','report_id' => '1','question' => 'Bagaimana kualitas penyambutan oleh security cabang kami ?','point' => '8','date' => '2024-01-08','created_at' => '2024-01-08 16:39:52','updated_at' => '2024-01-10 16:39:52'),
            array('id' => '4','report_id' => '1','question' => 'Bagaimana keramahan petugas yang melayani ?','point' => '8','date' => '2024-01-08','created_at' => '2024-01-08 00:00:00','updated_at' => '2024-01-10 16:39:52'),
            array('id' => '5','report_id' => '1','question' => 'Bagaimana pengetahuan petugas yang melayani ?','point' => '8','date' => '2024-01-08','created_at' => '2024-01-08 16:39:52','updated_at' => '2024-01-10 16:39:52'),
            array('id' => '6','report_id' => '1','question' => 'Bagaimana ruang banking hall ?','point' => '6','date' => '2024-01-08','created_at' => '2024-01-08 00:00:00','updated_at' => '2024-01-10 16:39:52'),
            array('id' => '7','report_id' => '2','question' => 'Bagaimana penampilan petugas yang melayani ?','point' => '8','date' => '2024-01-08','created_at' => '2024-01-08 16:40:11','updated_at' => '2024-01-10 16:40:11'),
            array('id' => '8','report_id' => '2','question' => 'Bagaimana kepuasan nasabah terhadap pelayanan kami ?','point' => '6','date' => '2024-01-08','created_at' => '2024-01-08 16:40:11','updated_at' => '2024-01-10 16:40:11'),
            array('id' => '9','report_id' => '2','question' => 'Bagaimana kualitas penyambutan oleh security cabang kami ?','point' => '8','date' => '2024-01-08','created_at' => '2024-01-08 00:00:00','updated_at' => '2024-01-10 16:40:11'),
            array('id' => '10','report_id' => '2','question' => 'Bagaimana keramahan petugas yang melayani ?','point' => '8','date' => '2024-01-08','created_at' => '2024-01-08 16:40:11','updated_at' => '2024-01-10 16:40:11'),
            array('id' => '11','report_id' => '2','question' => 'Bagaimana pengetahuan petugas yang melayani ?','point' => '8','date' => '2024-01-08','created_at' => '2024-01-08 00:00:00','updated_at' => '2024-01-10 16:40:11'),
            array('id' => '12','report_id' => '2','question' => 'Bagaimana ruang banking hall ?','point' => '7','date' => '2024-01-08','created_at' => '2024-01-08 16:40:11','updated_at' => '2024-01-10 16:40:11'),
            array('id' => '13','report_id' => '3','question' => 'Bagaimana penampilan petugas yang melayani ?','point' => '3','date' => '2024-01-08','created_at' => '2024-01-08 00:00:00','updated_at' => '2024-01-10 16:40:27'),
            array('id' => '14','report_id' => '3','question' => 'Bagaimana kepuasan nasabah terhadap pelayanan kami ?','point' => '6','date' => '2024-01-08','created_at' => '2024-01-08 16:40:27','updated_at' => '2024-01-10 16:40:27'),
            array('id' => '15','report_id' => '3','question' => 'Bagaimana kualitas penyambutan oleh security cabang kami ?','point' => '2','date' => '2024-01-08','created_at' => '2024-01-08 00:00:00','updated_at' => '2024-01-10 16:40:27'),
            array('id' => '16','report_id' => '3','question' => 'Bagaimana keramahan petugas yang melayani ?','point' => '7','date' => '2024-01-08','created_at' => '2024-01-08 00:00:00','updated_at' => '2024-01-10 16:40:27'),
            array('id' => '17','report_id' => '3','question' => 'Bagaimana pengetahuan petugas yang melayani ?','point' => '3','date' => '2024-01-08','created_at' => '2024-01-08 16:40:27','updated_at' => '2024-01-10 16:40:27'),
            array('id' => '18','report_id' => '3','question' => 'Bagaimana ruang banking hall ?','point' => '7','date' => '2024-01-08','created_at' => '2024-01-08 00:00:00','updated_at' => '2024-01-10 16:40:27'),
            array('id' => '19','report_id' => '4','question' => 'Bagaimana penampilan petugas yang melayani ?','point' => '2','date' => '2024-01-10','created_at' => '2024-01-10 16:47:10','updated_at' => '2024-01-10 16:47:10'),
            array('id' => '20','report_id' => '4','question' => 'Bagaimana kepuasan nasabah terhadap pelayanan kami ?','point' => '8','date' => '2024-01-10','created_at' => '2024-01-10 16:47:10','updated_at' => '2024-01-10 16:47:10'),
            array('id' => '21','report_id' => '4','question' => 'Bagaimana kualitas penyambutan oleh security cabang kami ?','point' => '6','date' => '2024-01-10','created_at' => '2024-01-10 16:47:10','updated_at' => '2024-01-10 16:47:10'),
            array('id' => '22','report_id' => '4','question' => 'Bagaimana keramahan petugas yang melayani ?','point' => '6','date' => '2024-01-10','created_at' => '2024-01-10 16:47:10','updated_at' => '2024-01-10 16:47:10'),
            array('id' => '23','report_id' => '4','question' => 'Bagaimana pengetahuan petugas yang melayani ?','point' => '7','date' => '2024-01-10','created_at' => '2024-01-10 16:47:10','updated_at' => '2024-01-10 16:47:10'),
            array('id' => '24','report_id' => '4','question' => 'Bagaimana ruang banking hall ?','point' => '','date' => '2024-01-10','created_at' => '2024-01-10 16:47:10','updated_at' => '2024-01-10 16:47:10'),
            array('id' => '25','report_id' => '4','question' => 'Bagaimana ruang banking hall ? revisi','point' => '8','date' => '2024-01-10','created_at' => '2024-01-10 16:47:10','updated_at' => '2024-01-10 16:47:10'),
            array('id' => '26','report_id' => '5','question' => 'Bagaimana penampilan petugas yang melayani ?','point' => '9','date' => '2024-01-10','created_at' => '2024-01-10 16:47:25','updated_at' => '2024-01-10 16:47:25'),
            array('id' => '27','report_id' => '5','question' => 'Bagaimana kepuasan nasabah terhadap pelayanan kami ?','point' => '9','date' => '2024-01-10','created_at' => '2024-01-10 16:47:25','updated_at' => '2024-01-10 16:47:25'),
            array('id' => '28','report_id' => '5','question' => 'Bagaimana kualitas penyambutan oleh security cabang kami ?','point' => '7','date' => '2024-01-10','created_at' => '2024-01-10 16:47:25','updated_at' => '2024-01-10 16:47:25'),
            array('id' => '29','report_id' => '5','question' => 'Bagaimana keramahan petugas yang melayani ?','point' => '7','date' => '2024-01-10','created_at' => '2024-01-10 16:47:25','updated_at' => '2024-01-10 16:47:25'),
            array('id' => '30','report_id' => '5','question' => 'Bagaimana pengetahuan petugas yang melayani ?','point' => '8','date' => '2024-01-10','created_at' => '2024-01-10 16:47:25','updated_at' => '2024-01-10 16:47:25'),
            array('id' => '31','report_id' => '5','question' => 'Bagaimana ruang banking hall ?','point' => '','date' => '2024-01-10','created_at' => '2024-01-10 16:47:25','updated_at' => '2024-01-10 16:47:25'),
            array('id' => '32','report_id' => '5','question' => 'Bagaimana ruang banking hall ? revisi','point' => '7','date' => '2024-01-10','created_at' => '2024-01-10 16:47:25','updated_at' => '2024-01-10 16:47:25')
          );
          

          DB::table('report_detail')->insert($report_detail);
    }
}
