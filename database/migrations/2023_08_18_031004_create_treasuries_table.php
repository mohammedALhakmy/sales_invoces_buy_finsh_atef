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
        Schema::create('treasuries', function (Blueprint $table) {
            $table->id();
            $table->string('name',255);
            $table->tinyInteger('is_master')->default(0)->comment('هل الخزنة رئيسية0-1');
            $table->bigInteger('last_isal_exchange')->comment('رقم اخر ايصال لصرف');
            $table->bigInteger('last_isal_collect')->comment('رقم اخر ايصال لتحصيل');
            $table->integer('added_by');
            $table->integer('updated_by');
            $table->integer('com_code');
            $table->tinyInteger('active')->default(1)->comment('معنا 1 مفعل 0 غير مفعل');
            $table->date('date')->comment('the for search');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treasuries');
    }
};
