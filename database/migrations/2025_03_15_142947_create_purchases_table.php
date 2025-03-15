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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id('purchases_id');
            $table->integer('product_id');
            $table->string('invoice_no');
            $table->date('purchases_date');
            $table->decimal('purchases_buy_amount',20,2);
            $table->decimal('purchases_sales_amount',20,2);
            $table->decimal('purchases_quantity',20,2);
            $table->decimal('purchases_previous_quantity',20,2)->nullable();
            $table->decimal('purchases_current_quantity',20,2)->nullable();
            $table->string('supplier_name')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('purchases');
    }
};
