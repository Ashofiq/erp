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
        Schema::create('acc_transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('companyId')->index('companyId');
            $table->string('transType');
            $table->bigInteger('voucherNo');
            $table->text('narration');
            $table->date('date');
            $table->string('fiscalYearId');
            $table->integer('createdBy');
            $table->integer('updatedBy');
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
        Schema::dropIfExists('acc_transactions');
    }
};
