<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitObservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visit_observations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('visit_id');
            $table->string('observation_name');
//            subjective
            $table->string('symptoms');
            $table->string('anamnesis');
            $table->string('prognosis');
//            objective
            $table->unsignedInteger('temperature');
            $table->unsignedInteger('awareness');
            $table->unsignedInteger('height');
            $table->unsignedInteger('weight');
            $table->unsignedInteger('systole');
            $table->unsignedInteger('diastole');
            $table->unsignedInteger('respiratory_rate');
            $table->unsignedInteger('heart_rate');
//            assessment
            $table->string('assessment');
//            plan
            $table->string('plan');

            $table->unsignedBigInteger('create_user_id');
            $table->unsignedBigInteger('update_user_id');

            $table->timestamps();

            $table->foreign('visit_id')->references('id')->on('visits')->onUpdate('cascade')->onDelete('cascade');
//            $table->foreign('staff_id')->references('id')->on('doctors')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('encounter_observations');
    }
}
