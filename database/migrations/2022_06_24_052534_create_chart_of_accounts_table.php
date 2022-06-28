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
        Schema::create('chart_of_accounts', function (Blueprint $table) {
            $table->id();
            $table->integer('companyId')->index('companyId');
            $table->integer('accCode');
            $table->string('accHead')->index('accHead');
            $table->integer('parentId');
            $table->integer('accLavel');
            $table->text('accOrigin');
            $table->integer('isMovedToCust');
            $table->integer('orderBy');
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
        Schema::dropIfExists('chart_of_accounts');
    }
};
