<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_user_id')->nullable(); 
            $table->string('transaction_sku')->nullable(); 
            $table->string('transaction_code');
            $table->string('transaction_number')->nullable(); // nomor tujuan 
            $table->string('transaction_type');
            $table->string('transaction_method');
            $table->bigInteger('transaction_total'); 
            $table->string('transaction_status'); 
            $table->string('bank');
            $table->string('va_number');
            $table->string('qr_code');
            $table->string('deeplink_redirect');
            $table->date('transaction_date');
            $table->dateTime('transaction_time');
            $table->dateTime('transaction_expired');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
