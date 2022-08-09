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
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->integer('employeeId')->index();
            $table->unsignedBigInteger('leaveTypeId');
            $table->foreign('leaveTypeId')->references('id')->on('leave_types');
            $table->date('startDate');
            $table->date('endDate');
            $table->date('appliedOn');
            $table->text('reason');
            $table->text('remark');
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
        Schema::dropIfExists('leaves');
    }
};
