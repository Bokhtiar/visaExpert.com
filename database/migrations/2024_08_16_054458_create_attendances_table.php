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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->enum('status', ['late', 'leave', 'normal', 'early_out']);
            $table->decimal('fine', 8, 2)->default(0);
            $table->time('punch_in');
            $table->time('punch_out')->nullable();
            $table->decimal('total_hour', 5, 2)->nullable();
            $table->decimal('late_hour', 5, 2)->nullable();
            $table->decimal('early_out_hour', 5, 2)->nullable();
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
