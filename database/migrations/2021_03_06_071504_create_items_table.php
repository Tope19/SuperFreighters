<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('trans_mode_id');
            $table->unsignedBigInteger('route_id');
            $table->string('sender_name');
            $table->string('sender_email');
            $table->string('package_name');
            $table->integer('weight');
            $table->double('tax', 12,2);
            $table->double('price', 12,2);
            $table->tinyInteger('payment_stat')->default(0);
            $table->string('payment_ref')->nullable();
            $table->string('description')->nullable();
            $table->foreign('trans_mode_id')->references('id')->on('transport_modes')->onDelete('cascade');
            $table->foreign('route_id')->references('id')->on('routes')->onDelete('cascade');
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
        Schema::dropIfExists('items');
    }
}
