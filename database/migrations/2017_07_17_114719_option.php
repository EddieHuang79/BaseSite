<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class Option extends Migration
{

    protected $option_table = "option";

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // option
        #   type: 1 - option-setting, 2 - other-setting
        Schema::create($this->option_table, function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type')->default(1);
            $table->string('key')->unique();
            $table->text('value');
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists($this->option_table);

    }
}
