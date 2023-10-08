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
            $table->bigInteger("ques1"); // 2. Bagaimana penampilan petugas yang melayani ?
            $table->bigInteger("ques2"); // 3. Bagaimana kecepatan petugas yang melayani ?
            $table->bigInteger("ques3"); // 4. Bagaimana kepuasan nasabah terhadap pelayanan kami ?
            $table->bigInteger("ques4"); // 5. Bagaimana kualitas penyambutan oleh security cabang kami ?
            $table->bigInteger("ques5"); // 6. Bagaimana keramahan petugas yang melayani ?
            $table->bigInteger("ques6"); // 7. Bagaimana pengetahuan petugas yang melayani ?
            $table->bigInteger("ques7"); // 8. Bagaimana ruang banking hall ?
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
