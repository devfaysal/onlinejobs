<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('image')->nullable();
            $table->string('full_image')->nullable();
            $table->integer('gender')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->integer('nationality')->nullable();
            $table->integer('religion')->nullable();
            $table->integer('native_language')->nullable();
            $table->string('other_languages')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('highest_education')->nullable();
            $table->string('skill_level')->nullable();
            //Maid Other Information
            $table->boolean('work_on_off_days_with_compensation')->nullable();
            $table->boolean('able_to_handle_pork')->nullable();
            $table->boolean('able_to_gardening')->nullable();
            $table->boolean('able_to_care_dog_cat')->nullable();
            $table->boolean('able_to_simple_sewing')->nullable();
            $table->boolean('able_to_wash_car')->nullable();
            $table->boolean('able_to_eat_pork')->nullable();
            //Maid Skill Work Area
            $table->boolean('able_to_care_infants')->nullable();
            $table->boolean('able_to_care_elderly')->nullable();
            $table->boolean('able_to_care_disabled')->nullable();
            $table->boolean('able_to_do_general_housework')->nullable();
            $table->boolean('able_to_cook')->nullable();


            $table->timestamps();

            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
