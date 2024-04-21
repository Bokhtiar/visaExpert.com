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
        Schema::create('staff_duty_salaries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->time('duty_finger_in')->nullable();
            $table->time('duty_finger_out')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_duty_salaries');
    }
};
