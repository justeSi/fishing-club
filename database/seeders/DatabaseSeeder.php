<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Manager;
use App\Models\Animal;
use Faker\Factory as Faker;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();



        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123'),
        ]);

        $reservoirs = ['Drūkšiai', 'Dysnai', 'Dusia', 'Vištytis', 'Sartai', 'Luodis', 'Metelys', 'Avilys', 'Plateliai', 'Rėkyva'];
        $rCount = count($reservoirs);
        
        for ($i=0; $i < $rCount ; $i++) { 
            DB::table('reservoirs') -> insert([
                'title' => $reservoirs[$i],
                'area' => rand(2.8, 63.50),
                'about' => $faker->text(400),

            ]);
        }
        $getId = 1;
        $exp = rand(2, 40);
        $reg = rand(1, $exp-1);
        for ($i=1; $i < 15; $i++) { 
            DB::table('members') -> insert([
                'name' => $faker->firstName(),
                'surname' => $faker->lastName(),
                'live' => $faker-> city(),
                'experience' => $exp,
                'registered' => $reg,
                'reservoir_id' => $getId,
                ]);
                $getId++;
                if ($i == $rCount) {
                    $getId = 1;
                }
            }
    }
}
