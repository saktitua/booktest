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
        Schema::create('auditTrail', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('menu')->nullable();
            $table->string('description')->nullable();
            $table->string('username')->nullable();
            $table->string('jenis_layanan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auditTrail');
    }
};
