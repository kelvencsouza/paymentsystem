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
    Schema::create('payments', function (Blueprint $table) {
        $table->id();
        $table->string('status');
        $table->string('method');
        $table->integer('installment');
        $table->unsignedBigInteger('product_id');
        $table->decimal('coupon_discount', 8, 2)->nullable();
        $table->string('short_id');
        $table->decimal('total_amount', 10, 2);
        $table->timestamps();

        // Definindo a foreign key para product_id
        $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
