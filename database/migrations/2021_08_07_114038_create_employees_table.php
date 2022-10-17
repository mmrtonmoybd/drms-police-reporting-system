<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('name')->nullable();
            $table->text('designation')->nullable();
            $table->text('education')->nullable();
            $table->date('birthday')->nullable();
            $table->text('phone')->nullable();
            $table->text('email')->nullable();
            $table->date('first_join_date')->nullable();
            $table->date('current_position_join_date')->nullable();
            $table->date('current_office_join_date')->nullable();
            $table->text('address')->nullable();
            $table->integer('ow_district')->nullable();
            $table->text('own_upazilla')->nullable();
            $table->text('description')->nullable();
            $table->integer('officeID')->nullable();
            $table->integer('divisionID')->nullable();
            $table->integer('districtID')->nullable();
            $table->integer('positionID')->nullable();
            $table->date('prl_date')->nullable();
            $table->integer('basic_salary')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
