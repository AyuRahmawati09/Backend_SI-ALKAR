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
        Schema::create('tracer_studi', function (Blueprint $table) {
            $table->id('id_tracer');
            $table->foreignId('id_alumni')->constrained('alumni', 'id_alumni')->onDelete('cascade');
            $table->string('pekerjaan');
            $table->string('nama_perusahaan');
            $table->enum('status_pekerjaan', ['bekerja', 'wirausaha', 'melanjutkan_studi', 'belum_bekerja']);
            $table->string('gaji');
            $table->string('lokasi_kerja')->nullable(); 
            $table->string('kesesuaian_pekerjaan')->nullable(); 
            $table->date('tanggal_mulai_bekerja')->nullable(); 
            $table->date('tanggal_isi');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracer_studi');
    }
};
