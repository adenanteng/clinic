<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitBillingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visit_billings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visit_id');
            $table->unsignedInteger('type');
            $table->unsignedInteger('name');
            $table->unsignedInteger('unit_price');
            $table->integer('unit');
            $table->unsignedInteger('subtotal');
            $table->integer('status');
            $table->timestamps();

            $table->foreign('visit_id')->references('id')->on('visits')->onUpdate('cascade')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visit_billings');
    }
}
