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
        Schema::create('investments', function (Blueprint $table) {
            $table->uuid("id")->primary();
            
            $table->decimal("initial_amount", 10, 2);
            $table->decimal("final_amount", 10, 2);
            $table->decimal("reinforcement", 10, 2)->nullable(); 

            $table->uuid("transfer_id")->index();
            $table->foreign('transfer_id')->references('id')->on('transfers');

            $table->uuid("entity_id")->nullable(); 
            $table->foreign('entity_id')->references('id')->on('entities');
    
            $table->uuid("category_id")->nullable();
            $table->foreign('category_id')->references('id')->on('categories');
    
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investments');
    }
};
