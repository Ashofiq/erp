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
            $table->integer('accTransId')->index('accTransId');
            $table->decimal('dAmount', 20,2)->nullable();
            $table->decimal('cAmount', 20,2)->nullable();
            $table->integer('chartOfAccId')->index('chartOfAccId');
            $table->text('description')->nullable();
            $table->bigInteger('accInvoiceNo')->nullable();
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
