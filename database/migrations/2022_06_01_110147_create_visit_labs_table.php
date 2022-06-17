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
            $table->id();
            $table->unsignedBigInteger('visit_id');
            $table->unsignedInteger('type_id');
            $table->unsignedBigInteger('treatment_id');
            $table->text('clinical');
            $table->text('date');
            $table->unsignedBigInteger('create_user_id');
            $table->unsignedInteger('status')->default(1);
            $table->timestamps();

            $table->foreign('visit_id')->references('id')->on('visits')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('treatment_id')->references('id')->on('treatments')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('create_user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
