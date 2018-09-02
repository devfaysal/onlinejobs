<?php

use Illuminate\Database\Seeder;
use App\Country;
use App\Gender;
use App\Language;
use App\MaritalStatus;
use App\Religion;
use App\SkillLevel;

class GeneralData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        //Add country
        $country_names = array( "Bangladesh", "India", "Malaysia");
        foreach($country_names as $country_name){
            $country = \App\Country::create([
                'name' => $country_name,
            ]);
        }

        //Add Gender
        $gender_names = array( "Male", "Female", "Other");
        foreach($gender_names as $gender_name){
            $gender = \App\Gender::create([
                'name' => $gender_name,
            ]);
        }

        //Add language
        $language_names = array( "English", "Bengali", "Malay");
        foreach($language_names as $language_name){
            $language = \App\Language::create([
                'name' => $language_name,
            ]);
        }

        //Add MaritalStatus
        $maritalstatus_names = array( "Single", "Married", "Divorced");
        foreach($maritalstatus_names as $maritalstatus_name){
            $maritalstatus = \App\MaritalStatus::create([
                'name' => $maritalstatus_name,
            ]);
        }

        //Add religion
        $religion_names = array( "Islam", "Christianity", "Hinduism");
        foreach($religion_names as $religion_name){
            $religion = \App\Religion::create([
                'name' => $religion_name,
            ]);
        }

        //Add skilllevel
        $skilllevel_names = array( "Beginner", "Intermidiate", "Expert");
        foreach($skilllevel_names as $skilllevel_name){
            $skilllevel = \App\SkillLevel::create([
                'name' => $skilllevel_name,
            ]);
        }

    }
}
