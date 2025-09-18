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
        Schema::create('customers', function (Blueprint $table) {
            $table->id(); // id (auto increment)

            $table->string("fullName")->nullable();
            $table->string("firstName")->nullable();
            $table->string("middleName")->nullable();
            $table->string("surname")->nullable();

            $table->date("dob")->nullable();
            $table->enum("gender", ["male", "female", "other"])->nullable();

            $table->string("birthCity")->nullable();
            $table->string("birthCountry")->nullable();
            $table->string("nationality")->nullable();

            $table->string("countryCode", 10)->nullable();
            $table->string("addressLine1")->nullable();
            $table->string("addressLine2")->nullable();
            $table->string("city")->nullable();
            $table->string("postcode", 20)->nullable();
            $table->string("region")->nullable();
            $table->string("countryResidence")->nullable();

            $table->string("phoneNum", 20)->nullable();
            $table->string("homeNumber", 20)->nullable();
            $table->string("alternativeEmail")->nullable();

            $table->string("occupation")->nullable();
            $table->string("companyName")->nullable();

            $table->string("email")->unique();
            $table->string("password");

            // ID details
            $table->string("idType")->nullable();
            $table->string("idNumber")->nullable();
            $table->date("idIssueDate")->nullable();
            $table->date("idExpireDate")->nullable();
            $table->string("idIFile")->nullable();

            // Address docs
            $table->string("addressDocType")->nullable();
            $table->date("addressDocIssueDate")->nullable();
            $table->date("addressDocExpireDate")->nullable();
            $table->string("addressFile")->nullable();

            // Proof of funds
            $table->string("proofFundDocType")->nullable();
            $table->date("proofFundDocIssueDate")->nullable();
            $table->date("proofFundDocExpireDate")->nullable();
            $table->string("proofFundFile")->nullable();

            // Banking details
            $table->string("account_number")->nullable();
            $table->string("keyCode")->nullable();

            // Device details
            $table->string("phoneIMEI")->nullable();
            $table->string("simSerial")->nullable();

            // Token
            $table->string("email_token")->nullable();
            $table->dateTime("token_expiration")->nullable();
            $table->boolean("token_validated")->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
