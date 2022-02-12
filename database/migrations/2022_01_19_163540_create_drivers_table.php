<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->integer('userId')->unsigned();
            $table->string('name');
            $table->string('phone');
            $table->text('address');
            $table->string('transportType');

            $table->string('licenseImage');
            $table->string('transportImage');

            $table->foreign('userId')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->integer('isAccepted')->default(0);
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
        Schema::dropIfExists('drivers');
    }
}
