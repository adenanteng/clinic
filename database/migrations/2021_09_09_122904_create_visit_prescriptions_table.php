<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitPrescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visit_prescriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('visit_id');
//            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('drug_id');
            $table->unsignedBigInteger('procurement_id');
            $table->unsignedInteger('frequency');
            $table->unsignedInteger('duration');
            $table->text('description')->nullable();
            $table->unsignedInteger('status')->default(1);
            $table->timestamps();

            $table->foreign('visit_id')->references('id')->on('visits')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('drug_id')->references('id')->on('pharmacies')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('procurement_id')->references('id')->on('pharmacy_procurements')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visit_prescriptions');
    }
}
