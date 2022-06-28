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
        Schema::create('acc_transaction_details', function (Blueprint $table) {
            $table->id();
            $table->integer('accTransId');
            $table->decimal('Damount', 20,2);
            $table->decimal('Camount', 20,2);
            $table->integer('chartOfAccId')->index('chartOfAccId');
            $table->bigInteger('accInvoiceNo');
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
        Schema::dropIfExists('acc_transaction_details');
    }
};
