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
        Schema::create('tsa_mgt_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('reference_code')->unique();
            $table->unsignedBigInteger('vendor_id')->index();
            $table->unsignedBigInteger('transaction_id')->index();

            $table->string('current_otp')->nullable();
            $table->string('hashed_current_otp')->nullable();

            $table->decimal('amount', 15, 2)->default(0.00);

            $table->string('fulfilment_status')->default('pending');
            $table->string('collection_status')->default('pending');

            $table->string('collection_mobile_no')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tsa_mgt_transactions');
    }
};
