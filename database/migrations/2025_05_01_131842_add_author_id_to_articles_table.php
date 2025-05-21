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
        Schema::table('articles', function (Blueprint $table) {
            // Tambahkan kolom author_id jika belum ada
            if (!Schema::hasColumn('articles', 'author_id')) {
                $table->foreignId('author_id')
                    ->constrained('authors') // pastikan ke tabel 'authors'
                    ->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            // Hapus foreign key dan kolom author_id saat rollback
            $table->dropForeign(['author_id']);
            $table->dropColumn('author_id');
        });
    }
};
