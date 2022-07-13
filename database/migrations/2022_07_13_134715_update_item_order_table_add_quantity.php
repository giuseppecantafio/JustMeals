<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateItemOrderTableAddQuantity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_order', function (Blueprint $table) {
            $table->unsignedSmallInteger('quantity')->default(0);
            $table->float('item_price', 5, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('item_order', function (Blueprint $table) {
            $table->dropColumn('quantity');
            $table->dropColumn('item_price');
        });
    }
}
