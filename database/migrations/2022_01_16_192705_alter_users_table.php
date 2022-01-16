<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->renameColumn('name', 'title');
            $table->longText('description');
            $table->tinyInteger('is_new');
            $table->tinyInteger('fuel');
            $table->integer('cm3');
            $table->integer('hp');
            $table->tinyInteger('transmission');
            $table->tinyInteger('color');
            $table->tinyInteger('coupe_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
