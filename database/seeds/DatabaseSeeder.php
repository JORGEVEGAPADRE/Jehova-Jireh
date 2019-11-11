<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersSeeder::class);
        $this->call(CountriesSeeder::class);
        $this->call(BloodtypesSeeder::class);
        $this->call(GendersSeeder::class);        
        $this->call(HierarchiesSeeder::class);
        $this->call(BanksSeeder::class); 
        $this->call(CivilstatesSeeder::class);        
        $this->call(JobstatesSeeder::class); 
        $this->call(MinistriesSeeder::class);
              
    }
}
