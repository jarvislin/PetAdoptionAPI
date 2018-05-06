<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->string('id'); // = animal_shelter_pkid + animal_id
            $table->string('animal_id');
            $table->string('animal_subid');
            $table->string('animal_area_pkid');
            $table->string('animal_shelter_pkid');
            $table->string('animal_place')->nullable();
            $table->string('animal_kind')->nullable();
            $table->string('animal_sex')->nullable();
            $table->string('animal_bodytype')->nullable();
            $table->string('animal_colour')->nullable();
            $table->string('animal_age')->nullable();
            $table->string('animal_sterilization')->nullable();
            $table->string('animal_bacterin')->nullable();
            $table->string('animal_foundplace')->nullable();
            $table->string('animal_title')->nullable();
            $table->string('animal_remark')->nullable();
            $table->string('animal_status');
            $table->string('animal_opendate');
            $table->string('animal_closeddate');
            $table->string('animal_update');
            $table->string('animal_createtime');
            $table->string('shelter_name');
            $table->string('album_file')->nullable();
            $table->string('shelter_address')->nullable();
            $table->string('shelter_tel')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animals');
    }
}
