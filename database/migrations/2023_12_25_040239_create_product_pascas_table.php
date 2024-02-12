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
        Schema::create('product_pascas', function (Blueprint $table) {
            $table->id();
            // $table->string('product_sku')->unique();
            // $table->string('product_name');
            // $table->string('product_category');
            // $table->string('product_provider');
            // $table->string('product_desc');
            // $table->string('product_seller');
            // $table->integer('product_transaction_admin');
            // $table->integer('product_transaction_fee');
            // $table->string('product_buyer_status', 5);
            // $table->string('product_seller_status', 5);
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
        Schema::dropIfExists('product_pascas');
    }
};
