<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */ 
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('userId')->unsigned();
            $table->integer('categoryId')->unsigned();
            $table->string('itemId');
            $table->integer('quantity');
            $table->string('delivary_time');
            $table->text('notes')->nullable();
            $table->integer('status')->default(0);
            $table->string('customerLat');
            $table->string('customerLng');

            $table->foreign('categoryId')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
            $table->foreign('userId')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->integer('isDeleted')->default(0);
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
        Schema::dropIfExists('orders');
    }
}
