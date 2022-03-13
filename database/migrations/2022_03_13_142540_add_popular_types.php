<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPopularTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement(
            <<<SQL
ALTER TABLE `vehicles_types`
ADD COLUMN `is_popular` TINYINT(1) NOT NULL DEFAULT 0 AFTER `category_id`;

SQL

        );

        DB::statement(
            <<<SQL
update vehicles_types set is_popular = 1 where name in ('Седан', 'Хечбек', 'Комби', 'Джип');
SQL

        );
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
