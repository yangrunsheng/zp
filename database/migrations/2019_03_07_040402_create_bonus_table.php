<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBonusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bs_bonus', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('total_amount',10,2)->comment('红包总金额');
            $table->decimal('left_amoun',10,2)->comment('红包剩余金额');
            $table->integer('total_nums')->default(0)->comment('红包个数');
            $table->integer('left_nums')->default(0)->comment('红包剩余个数');
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
        Schema::dropIfExists('bs_bonus');
    }
}
