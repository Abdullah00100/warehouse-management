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
        Schema::create('export_inventory_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('export_id');
            $table->unsignedBigInteger('inventory_product_id');
            $table->integer('export_product_price')->nullable();
            $table->integer('quantity');
            $table->timestamps();
            $table->foreign('export_id')
                ->references('id')
                ->on('exports');
            $table->foreign('inventory_product_id')
            ->references('id')
            ->on('inventory_products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('export_inventory_products');
    }
};
