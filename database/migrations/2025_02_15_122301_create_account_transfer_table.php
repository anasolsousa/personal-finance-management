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
        Schema::create('account_transfer', function (Blueprint $table) {
            $table->uuid("id")->primary();

            $table->uuid("destination_account_id");
            $table->foreign('destination_account_id')->references('id')->on('accounts');
    
            $table->uuid("transfer_id");
            $table->foreign('transfer_id')->references('id')->on('transfers');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_transfer');
    }
};
