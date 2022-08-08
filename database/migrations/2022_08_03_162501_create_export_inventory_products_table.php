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
            $table->foreignId('export_id')->nullable()->constrained('exports')->cascadeOnDelete();
            $table->foreignId('inventory_product_id')->nullable()->constrained('inventory_products')->cascadeOnDelete();
            $table->integer('export_product_price')->nullable();
            $table->integer('quantity');
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
        Schema::dropIfExists('export_inventory_products');
    }
};
