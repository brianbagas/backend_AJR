<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER id_trn BEFORE INSERT ON transaksi FOR EACH ROW

         BEGIN
                INSERT INTO sequence__t_r_n_s VALUES (NULL);
                IF NEW.id_driver IS NULL THEN 
                SET NEW.custom_id = CONCAT("TRN",DATE_FORMAT(NOW(), "%y%m%d"),"00","-",LPAD(LAST_INSERT_ID(), 3, "0"));
                ELSE
                SET NEW.custom_id = CONCAT("TRN",DATE_FORMAT(NOW(), "%y%m%d"),"01","-",LPAD(LAST_INSERT_ID(), 3, "0"));
                END IF;
                
            END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER "id_trn"');
    }
};