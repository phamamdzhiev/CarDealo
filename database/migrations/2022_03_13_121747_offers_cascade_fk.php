<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OffersCascadeFk extends Migration
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
ALTER TABLE `vehicles`
DROP FOREIGN KEY `fk_vehicles_1`,
DROP FOREIGN KEY `fk_vehicles_2`,
DROP FOREIGN KEY `fk_vehicles_3`,
DROP FOREIGN KEY `fk_vehicles_4`,
DROP FOREIGN KEY `fk_vehicles_5`,
DROP FOREIGN KEY `fk_vehicles_6`,
DROP FOREIGN KEY `fk_vehicles_7`;
SQL

        );

        $sql = <<<SQL
ALTER TABLE `vehicles`
ADD CONSTRAINT `fk_vehicles_1`
  FOREIGN KEY (`offer_id`)
  REFERENCES `offers` (`id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE,
ADD CONSTRAINT `fk_vehicles_2`
  FOREIGN KEY (`brand_id`)
  REFERENCES `brands` (`id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE,
ADD CONSTRAINT `fk_vehicles_3`
  FOREIGN KEY (`model_id`)
  REFERENCES `models` (`id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE,
ADD CONSTRAINT `fk_vehicles_4`
  FOREIGN KEY (`transmission_id`)
  REFERENCES `transmissions` (`id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE,
ADD CONSTRAINT `fk_vehicles_5`
  FOREIGN KEY (`fuel_id`)
  REFERENCES `fuels` (`id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE,
ADD CONSTRAINT `fk_vehicles_6`
  FOREIGN KEY (`color_id`)
  REFERENCES `colors` (`id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE,
ADD CONSTRAINT `fk_vehicles_7`
  FOREIGN KEY (`type_id`)
  REFERENCES `vehicles_types` (`id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;
SQL;

       DB::statement($sql);

       DB::statement(
           <<<SQL
ALTER TABLE `vehicles_boats`
DROP FOREIGN KEY `fk_vehicles_boats_1`;
SQL

       );
       DB::statement(
           <<<SQL
ALTER TABLE `vehicles_boats`
ADD CONSTRAINT `fk_vehicles_boats_1`
  FOREIGN KEY (`vehicle_id`)
  REFERENCES `vehicles` (`id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;


SQL

       );

       DB::statement(
           <<<SQL
ALTER TABLE `vehicles_caravan`
DROP FOREIGN KEY `fk_vehicles_caravan_1`;
SQL

       );
       DB::statement(
         <<<SQL
ALTER TABLE `vehicles_caravan`
ADD CONSTRAINT `fk_vehicles_caravan_1`
  FOREIGN KEY (`vehicle_id`)
  REFERENCES `vehicles_caravan` (`id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;
SQL

       );

       DB::statement(
           <<<SQL
ALTER TABLE `offers`
DROP FOREIGN KEY `fk_offers_1`,
DROP FOREIGN KEY `fk_offers_2`;
SQL

       );
       DB::statement(
           <<<SQL
ALTER TABLE `offers`
ADD CONSTRAINT `fk_offers_1`
  FOREIGN KEY (`user_id`)
  REFERENCES `users` (`id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE,
ADD CONSTRAINT `fk_offers_2`
  FOREIGN KEY (`city_id`)
  REFERENCES `cities` (`id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;
SQL

       );

       DB::statement(
           <<<SQL
ALTER TABLE `vehicles_extra`
DROP FOREIGN KEY `fk_vehicles_extra_1`,
DROP FOREIGN KEY `fk_vehicles_extra_2`;
SQL

       );

       DB::statement(
           <<<SQL
ALTER TABLE `vehicles_extra`
ADD CONSTRAINT `fk_vehicles_extra_1`
  FOREIGN KEY (`extra_id`)
  REFERENCES `extras` (`id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE,
ADD CONSTRAINT `fk_vehicles_extra_2`
  FOREIGN KEY (`vehicle_id`)
  REFERENCES `vehicles` (`id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;
SQL

       );

       DB::statement(
           <<<SQL
ALTER TABLE `offer_visits`
DROP FOREIGN KEY `offer_visits_offer_id_foreign`;
SQL

       );

       DB::statement(
           <<<SQL
ALTER TABLE `offer_visits`
ADD CONSTRAINT `offer_visits_offer_id_foreign`
  FOREIGN KEY (`offer_id`)
  REFERENCES `offers` (`id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;
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
