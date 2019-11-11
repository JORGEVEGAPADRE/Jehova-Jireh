<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class GendersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genders=array("Femenino","Masculino");
        $arrlength = count($genders);
        for($i = 0; $i <$arrlength; $i++) {
          DB::table('genders')->insert(['sex'=>$genders[$i]]);
        }
       
    }
}
