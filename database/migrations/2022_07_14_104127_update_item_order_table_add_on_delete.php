<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateItemOrderTableAddOnDelete extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_order', function (Blueprint $table) {

            $table->unsignedBigInteger('item_id')->onDelete('set null')->nullable()->change();
            $table->unsignedBigInteger('order_id')->onDelete('set null')->nullable()->change();

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

            $table->unsignedBigInteger('item_id')->onDelete()->nullable(false)->change();
            $table->unsignedBigInteger('order_id')->onDelete()->nullable(false)->change();

        });
    }
}
