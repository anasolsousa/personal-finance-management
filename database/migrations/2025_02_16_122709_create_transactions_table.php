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
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->datetime("date");
            $table->text("notes")->nullable(); 
            $table->decimal("amount", 10, 2);
            $table->enum('type', ['income', 'expense']);
            $table->string('payment_method')->nullable();
            
            $table->uuid("account_id");
            $table->foreign('account_id')->references('id')->on('accounts');

            $table->uuid("entity_id"); 
            $table->foreign('entity_id')->references('id')->on('entities');

            $table->uuid("sub_entity_id"); 
            $table->foreign('sub_entity_id')->references('id')->on('sub_entities');

            $table->uuid("category_id"); 
            $table->foreign('category_id')->references('id')->on('categories');

            $table->uuid("sub_category_id"); 
            $table->foreign('sub_category_id')->references('id')->on('sub_categories');

            $table->uuid("user_id"); // table externa
            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
