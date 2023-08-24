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
        Schema::create('treasurie_deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('treasurie_id')->constrained('treasuries','id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('treasuries_can_delivery_id')->comment('الخزنة التي يتم تسليمها');
            $table->integer('added_by');
            $table->integer('updated_by');
            $table->integer('com_code');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treasurie_deliveries');
    }
};
