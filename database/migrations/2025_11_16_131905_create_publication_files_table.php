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
        Schema::create('publication_files', function (Blueprint $table) {
            $table->id('file_id');
            $table->unsignedBigInteger('publication_id');
            $table->string('file_name'); // Nama asli file dari user
            $table->string('file_path'); // Path di storage/app/public/publications/
            $table->string('file_type', 10)->nullable(); // pdf, xlsx, docx, zip
            $table->unsignedBigInteger('file_size')->nullable(); // dalam bytes
            $table->timestamps();

            // Foreign key ke tabel publications
            $table->foreign('publication_id')
                  ->references('publication_id')
                  ->on('publications')
                  ->onDelete('cascade'); // Hapus file jika publikasi dihapus
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publication_files');
    }
};