<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('publication_plans', function (Blueprint $table) {
            $table->id('pub_plan_id');
            $table->unsignedBigInteger('publication_id');
            $table->string('plan_name'); // Nama output publikasi
            $table->date('plan_date')->nullable(); // Tanggal rencana terbit
            $table->text('plan_desc')->nullable(); // Deskripsi rencana
            $table->string('plan_file')->nullable(); // File rencana (draft)
            $table->timestamps();

            $table->foreign('publication_id')
                  ->references('publication_id')
                  ->on('publications')
                  ->onDelete('cascade');
        });

        Schema::create('publication_finals', function (Blueprint $table) {
            $table->id('pub_final_id');
            $table->unsignedBigInteger('pub_plan_id');
            $table->date('actual_date')->nullable(); // Tanggal realisasi terbit
            $table->text('final_desc')->nullable(); // Deskripsi realisasi
            $table->string('final_file')->nullable(); // File publikasi final
            $table->timestamps();

            $table->foreign('pub_plan_id')
                  ->references('pub_plan_id')
                  ->on('publication_plans')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('publication_finals');
        Schema::dropIfExists('publication_plans');
    }
};