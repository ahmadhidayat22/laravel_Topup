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
        Schema::create('product_prepaids', function (Blueprint $table) {
            $table->id();
            // $table->string('product_sku')->unique();
            // $table->string('product_name');
            // $table->text('product_desc');
            // $table->string('product_category');
            // $table->string('product_provider');
            // $table->string('product_type');
            // $table->string('product_seller');
            // $table->integer('product_seller_price');
            // $table->integer('product_buyer_price');
            // $table->string('product_unlimited_stock' , 5);
            // $table->integer('product_stock');
            // $table->string('product_multi', 5);
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
        Schema::dropIfExists('product_prepaids');
    }
};
