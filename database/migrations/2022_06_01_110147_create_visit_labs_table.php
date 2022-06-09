<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visit_labs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('visit_id');
            $table->unsignedInteger('type');
            $table->unsignedInteger('treatment_id');
            $table->text('klinis');
            $table->text('description');
            $table->text('date');
            $table->unsignedInteger('status');
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
        Schema::dropIfExists('visit_labs');
    }
}
