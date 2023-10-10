<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('report', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cabang_id');
            $table->bigInteger('role_id');
            $table->bigInteger('user_id');
            $table->string("nama")->nullable();
            $table->bigInteger("ques1")->default('0'); // 2. Bagaimana penampilan petugas yang melayani ?
            $table->bigInteger("ques2")->default('0'); // 3. Bagaimana kecepatan petugas yang melayani ?
            $table->bigInteger("ques3")->default('0'); // 4. Bagaimana kepuasan nasabah terhadap pelayanan kami ?
            $table->bigInteger("ques4")->default('0'); // 5. Bagaimana kualitas penyambutan oleh security cabang kami ?
            $table->bigInteger("ques5")->default('0'); // 6. Bagaimana keramahan petugas yang melayani ?
            $table->bigInteger("ques6")->default('0'); // 7. Bagaimana pengetahuan petugas yang melayani ?
            $table->bigInteger("ques7")->default('0'); // 8. Bagaimana ruang banking hall ?
            $table->date('date');
            $table->text("reason")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report');
    }
};
