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
        Schema::create('product_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_product');
            $table->string('product_sku')->unique()->nullable();
            $table->string('product_name');
            $table->string('product_denom');
            $table->string('product_category');

            $table->string('product_type');
            $table->string('product_seller')->nullable();
            $table->integer('product_seller_price');
            $table->integer('product_buyer_price');
            $table->string('product_status_buyer', 5);
            $table->string('product_status_seller' ,5);
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
        Schema::dropIfExists('product_details');
    }
};
