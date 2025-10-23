<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendance_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attendance_session_id')->constrained('attendance_sessions')->onDelete('cascade');
            $table->foreignId('training_member_id')->constrained('training_members')->onDelete('cascade');
            $table->enum('status', ['hadir', 'izin', 'sakit', 'absen'])->default('absen');
            $table->text('notes')->nullable();
            $table->timestamps();

            // Memastikan setiap peserta hanya punya 1 rekor per sesi
            $table->unique(['attendance_session_id', 'training_member_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendance_records');
    }
};