<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return vointeger
     */
    public function up()
    {
        Schema::create('operation_securities', function (Blueprint $table) {
            $table->id();
            $table->integer('payments');
            $table->integer('receipts');
            $table->integer('profits');
            $table->integer('os_data');
            $table->integer('total_p');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return vointeger
     */
    public function down()
    {
        Schema::dropIfExists('operation_securities');
    }
};
