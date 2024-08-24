<?php

use App\Enums\PaymentStatus;
use App\Enums\VisaStatus;
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
        Schema::create('visa_forms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete();
            $table->foreignId('visa_type_id')->nullable()->constrained('visa_types');
            $table->enum('visa_status', VisaStatus::collection()->toArray())->default(VisaStatus::PENDING->toString());
            $table->enum('payment_status', PaymentStatus::collection()->toArray())->default(PaymentStatus::DUE->toString());
            $table->string('created_by')->nullable();
            $table->softDeletes();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visa_forms');
    }
};
