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
         CREATE TRIGGER id_cus BEFORE INSERT ON Customer FOR EACH ROW
            BEGIN
                INSERT INTO sequence__c_u_s VALUES (NULL);
                SET NEW.custom_id = CONCAT("CUS",DATE_FORMAT(NOW(), "%y%m%d"),"-",LPAD(LAST_INSERT_ID(), 3, "0"));
        
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
       DB::unprepared('DROP TRIGGER "id_cus"');
    }
};
