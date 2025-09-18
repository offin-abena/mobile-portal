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
        Schema::create('main_transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('transactionTypes')->nullable();
            $table->string('transaction_uid')->unique();
            $table->string('link_reference')->nullable();
            $table->string('transactionStatus')->nullable();

            $table->string('senderCountryCode', 5)->nullable();
            $table->string('recipientCountryCode', 5)->nullable();

            $table->unsignedBigInteger('senderID')->nullable();
            $table->unsignedBigInteger('recipientID')->nullable();

            $table->decimal('sendersAmount', 15, 2)->nullable();
            $table->decimal('recipientAmount', 15, 2)->nullable();
            $table->decimal('senderBalance', 15, 2)->nullable();
            $table->decimal('recipientBalance', 15, 2)->nullable();
            $table->decimal('fee', 15, 2)->nullable();
            $table->decimal('exRate', 15, 6)->nullable();

            $table->unsignedBigInteger('pricing_id')->nullable();
            $table->string('deviceType')->nullable();
            $table->dateTime('completedDate')->nullable();

            $table->string('foreignId')->nullable();
            $table->text('comment')->nullable();
            $table->unsignedBigInteger('refund_provider_id')->nullable();

            $table->string('airtimeNumber')->nullable();
            $table->string('airtimeChannel')->nullable();

            // W- fields (wallet?)
            $table->unsignedBigInteger('w_customerID')->nullable();
            $table->string('w_sender_name')->nullable();
            $table->string('w_idType')->nullable();
            $table->string('w_idNumber')->nullable();
            $table->date('w_idIssuedDate')->nullable();
            $table->date('w_idExpDate')->nullable();
            $table->string('w_email')->nullable();
            $table->string('w_phoneNumber')->nullable();

            // Remittance fields
            $table->string('remitRecipientName')->nullable();
            $table->string('remitRecipientMomoName')->nullable();
            $table->string('remitRecipientMomoNumber')->nullable();
            $table->string('remitRecipientChannel')->nullable();
            $table->string('remitRecipientBankName')->nullable();
            $table->string('remitRecipientBankAccount')->nullable();
            $table->string('remitRecipientBankAccountName')->nullable();

            $table->string('rechargeToken')->nullable();
            $table->string('externalTransactionId')->nullable();
            $table->string('rechargeMode')->nullable();
            $table->string('statusDescription')->nullable();

            $table->string('bundlePackage')->nullable();
            $table->string('auto_reverse_status')->nullable();
            $table->string('bill_type')->nullable();
            $table->string('billCode')->nullable();
            $table->string('async_id')->nullable();
            $table->string('receipt')->nullable();

            $table->string('app_version')->nullable();
            $table->string('sdk_version')->nullable();

            $table->unsignedBigInteger('provider_id')->nullable();
            $table->unsignedBigInteger('fund_source_id')->nullable();

            $table->string('write_status')->nullable();
            $table->string('purpose')->nullable();

            // Indexes for faster lookups
            $table->index(['transaction_uid']);
            $table->index(['senderID', 'recipientID']);
            $table->index(['provider_id', 'fund_source_id']);

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('main_transactions');
    }
};
