<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\AgentProfile;

class AgentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = array( "Dewalt", "Ebner", "Frick", "Hancock", "Haworth", "Hesch", "Hoffman", "Kassing", "Knutson", "Lawless" );
        foreach($names as $name){
            // Create default user for each role
            $user = \App\User::create([
                'name' => $name,
                'email' => $name.'@app.com',
                'phone' => '0123456789',
                'password' => bcrypt('password'),
                'public_id' => time().md5($name.'@app.com'),
            ]);

            $user->attachRole('agent');

            $profile = new AgentProfile;
            $profile->agent_code = time();
            $profile->user_id = $user->id;
            $profile->user_id = $user->id;
            $profile->first_name = $user->name;
            $profile->phone = $user->phone;
            $profile->save();
        }
    }
}
