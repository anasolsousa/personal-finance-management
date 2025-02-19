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
            $table->uuid('id')->primary();
            $table->date('date');
            $table->text('notes')->nullable();
            $table->decimal('amount', 10, 2);
            $table->string('type'); // account_transfer, saving, investment

            $table->uuid('account_from_id')->nullable(); // Conta de origem
            $table->foreign('account_from_id')->references('id')->on('accounts');

            $table->uuid('account_to_id')->nullable(); // Para transferências entre contas
            $table->foreign('account_to_id')->references('id')->on('accounts');

            $table->uuid("entity_id"); 
            $table->foreign('entity_id')->references('id')->on('entities');

            $table->uuid("sub_entity_id"); 
            $table->foreign('sub_entity_id')->references('id')->on('sub_entities');

            $table->uuid("category_id"); 
            $table->foreign('category_id')->references('id')->on('categories');

            $table->uuid("sub_category_id"); 
            $table->foreign('sub_category_id')->references('id')->on('sub_categories');

            $table->decimal('initial_amount', 10, 2)->nullable(); // Para investimentos
            $table->decimal('final_amount', 10, 2)->nullable(); // Para investimentos
            $table->decimal('reinforcement', 10, 2)->nullable(); // Para savings/investments
            $table->date('end_date')->nullable(); // Para savings
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
