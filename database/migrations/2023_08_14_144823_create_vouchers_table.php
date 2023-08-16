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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('voucher');
            $table->string('phone')->nullable();
            $table->string('voucher_number');
            $table->integer('total');
            $table->integer('tax');
            $table->integer('net_total');
            $table->foreignId('user_id');
//            $table->string('vouchers');
//            $table->string('customer')->default('unknown')->nullable();
//            $table->string('phone')->nullable();
//            $table->string('voucher_number');
//            $table->integer('total')->default(0);
//            $table->integer('tax')->default(0);
//            $table->integer('net_total')->default(0);
//            $table->foreignId('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
