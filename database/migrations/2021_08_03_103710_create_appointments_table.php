<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('doctor_id');
            $table->unsignedBigInteger('patient_id');
            $table->string('date');
            $table->string('from_time')->nullable();
//            $table->string('from_time_type')->nullable();
            $table->string('to_time')->nullable();
//            $table->string('to_time_type')->nullable();
            $table->boolean('status')->default(1);
            $table->text('description')->nullable();
            $table->unsignedBigInteger('service_id');
//            $table->integer('payable_amount');
            $table->integer('payment_type');
            $table->integer('payment_method');
            $table->string('appointment_unique_id')->unique();
            $table->timestamps();

            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('appointments');
    }
}
