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
        Schema::create('question', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->integer('is_edit')->default(0);
            $table->integer('is_delete')->default(0);
            $table->integer('is_new_edit')->default(0);
            $table->string('type');
            // $table->string('point_1');
            // $table->string('point_2');
            // $table->string('point_3');
            // $table->string('point_4');
            // $table->string('point_5');
            // $table->string('point_6');
            // $table->string('point_7');
            // $table->string('point_8');
            // $table->string('point_9');
            // $table->string('point_10');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question');
    }
};
