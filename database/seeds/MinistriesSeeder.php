<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class MinistriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {               
        $ministries=array("Apostoles","Profetas","Evangelistas","Pastores","Maestros");
        $arrlength = count($ministries);
        for($i = 0; $i <$arrlength; $i++) {
          DB::table('ministries')->insert([
            'ministry'=>$ministries[$i],
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
          
        }
    }
}
