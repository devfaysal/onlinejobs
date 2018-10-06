<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Profile;

class WorkerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = array( "Anderson", "Ashwoon", "Aikin", "Bateman", "Bongard", "Bowers", "Boyd", "Cannon", "Cast", "Deitz" );
        foreach($names as $name){
            // Create default user for each role
            $user = \App\User::create([
                'name' => $name,
                'email' => $name.'@app.com',
                'phone' => '0123456789',
                'password' => bcrypt('password'),
                'public_id' => time().md5($name.'@app.com'),
            ]);

            $user->attachRole('worker');

            $profile = new Profile;
            $profile->user_id = $user->id;
            $profile->agent_code = 'agent';
            $profile->name = $user->name;
            $profile->phone = $user->phone;
            $profile->save();
        }
    }
}
