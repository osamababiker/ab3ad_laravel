<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('orderId')->unsigned();
            $table->foreign('orderId')
                ->references('id')
                ->on('orders')
                ->onDelete('cascade');
            $table->integer('driverId')->unsigned();
            $table->foreign('driverId')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->integer('customerId')->unsigned();
            $table->foreign('customerId')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->integer('isAccepted')->default(0);
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
        Schema::dropIfExists('delivery_requests');
    }
}
