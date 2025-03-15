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
        Schema::create('sales__details', function (Blueprint $table) {
            $table->id('sales_details_id');
            $table->integer('sales_id');
            $table->integer('product_id');
            $table->string('invoice_no');
            $table->decimal('product_unit_price',20,2);
            $table->integer('product_quantity');
            $table->date('sales_date');
            $table->string('action_type',50)->nullable();
            $table->string('user_id',200)->nullable();
            $table->date('action_date')->nullable();
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
        Schema::dropIfExists('sales__details');
    }
};
