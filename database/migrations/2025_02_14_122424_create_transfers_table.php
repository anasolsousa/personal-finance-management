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
            $table->uuid("id")->primary();
            $table->datetime("date");
            $table->text("notes")->nullable(); 
            $table->decimal("amount", 10, 2);
            $table->enum('type', ['account_transfer', 'saving', 'investment']);

            $table->uuid("account_from_id");
            $table->foreign('account_from_id')->references('id')->on('accounts');

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
