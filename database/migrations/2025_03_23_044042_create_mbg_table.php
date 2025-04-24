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
        Schema::create('mbgs', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('foto');
            $table->integer('total_hadir')->default(0);
            $table->boolean('diambil')->default(false);
            $table->boolean('dikembalikan')->default(false);
            $table->integer('total_siswa')->default(0);
            $table->text('keteranganmbg');
            $table->timestamps();
            $table->foreignId('id_kelas')->constrained('classes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mbgs');
}
};