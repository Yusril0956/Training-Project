<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->id(); // sama dengan INT AUTO_INCREMENT PRIMARY KEY
            $table->string('nama_pengirim', 100);
            $table->string('email', 100)->nullable();
            $table->text('pesan');
            $table->dateTime('tanggal_kirim')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps(); // This will add created_at and updated_at columns
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
