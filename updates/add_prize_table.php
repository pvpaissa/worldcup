<?php

namespace Cleanse\WorldCup\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class AddPrizeTable extends Migration
{
    public function up()
    {
        Schema::create('cleanse_cup_prizes', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('value');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cleanse_cup_prizes');
    }
}
