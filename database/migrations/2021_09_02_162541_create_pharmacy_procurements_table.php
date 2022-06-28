<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePharmacyProcurementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pharmacy_procurements', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('drug_id');
            $table->unsignedInteger('supplier_id')->nullable();
            $table->unsignedBigInteger('amount');
            $table->bigInteger('remaining');
            $table->boolean('lifetime');
            $table->string('expired_date')->nullable();
            $table->string('invoice_no')->unique();
            $table->unsignedInteger('purchase_price')->nullable();
            $table->unsignedInteger('selling_price')->nullable();
            $table->unsignedInteger('selling_price_bpjs')->nullable();
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
        Schema::dropIfExists('pharmacy_procurements');
    }
}
