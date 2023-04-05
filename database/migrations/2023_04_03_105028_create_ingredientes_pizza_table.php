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
        Schema::create('ingredientes_pizza', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pizza_id');
            $table->foreign('pizza_id')
                ->references('id')->on('pizzas')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('ingrediente_id');
            $table->foreign('ingrediente_id')
                ->references('id')->on('ingredientes')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('ingredientes_pizza');
    }
};
