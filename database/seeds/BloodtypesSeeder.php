<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
class BloodtypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {               
        $bloodtype=array("O-","O+","A+","B-","B+","AB-","AB+");
        $arrlength = count($bloodtype);
        for($i = 0; $i <$arrlength; $i++) {
          DB::table('bloodtypes')->insert(['bloodtype'=>$bloodtype[$i]]);
        }
    }
}
