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
        Schema::create('training_members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('training_id')->constrained('trainings')->cascadeOnDelete()->index();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->index();
            $table->enum('status', ['accept', 'pending', 'graduate']);
            $table->string('series')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_members');
    }
};
