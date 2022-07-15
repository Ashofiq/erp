<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('employeeId')->index('employeeId');
            $table->string('name');
            $table->integer('departmentId')->index('departmentId');
            $table->integer('sectionId')->index('sectionId');
            $table->integer('designationId')->index('designationId');
            $table->integer('shiftId')->index('shiftId');
            $table->string('headOfDepartment');
            $table->integer('reportingTo');
            $table->string('empType');
            $table->string('pfMember');
            $table->date('joiningDate');
            $table->text('jobLocation');
            $table->decimal('grossSalary', 20,2);
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
        Schema::dropIfExists('employees');
    }
};
