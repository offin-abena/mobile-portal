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
        Schema::table('main_transactions', function (Blueprint $table) {
            $table->string('b_bus_id')->nullable();
            $table->string('b_bus_collection_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('main_transactions', function (Blueprint $table) {
            $table->dropColumn('b_bus_id');
            $table->dropColumn('b_bus_collection_id');
        });
    }
};
