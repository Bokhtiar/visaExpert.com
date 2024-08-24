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
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->integer('recive_id')->nullable();
            $table->integer('created_by')->nullable();
            $table->text('remark')->nullable();
            $table->integer('amount')->nullable();
            $table->longText('description')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected','others'])->default('pending');
            $table->timestamps();
        });
    }
     
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfers');
    }
};
