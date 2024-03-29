<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('nric_type')->nullable();
            $table->unsignedBigInteger('nric_id')->nullable();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('region_code')->default(62)->nullable();
            $table->string('contact')->nullable();
            $table->date('dob')->nullable();
            $table->integer('gender')->nullable();
            $table->string('marriage')->nullable();
            $table->string('religion')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('profession')->nullable();
            $table->string('language')->default('id')->nullable();
            $table->string('password');
            $table->integer('type')->nullable();
            $table->string('time_zone')->nullable();
            $table->boolean('dark_mode')->default(false);
            $table->boolean('status')->default(1);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
