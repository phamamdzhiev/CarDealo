<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OfferVisit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offer_visits', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('offer_id');
            $table->ipAddress('ip');
            $table->timestamps();
            $table->foreign('offer_id')->references('id')->on('offers');
        });

        Schema::table('offers', function (Blueprint $table) {
            $table->addColumn('integer', 'visits', ['default' => 0]);
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
