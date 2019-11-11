<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
            
class CivilstatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {               
        $civilstates=array("Soltero(a)","Casado(a)","Viudo(a)","Divorciado(a)","Concubino(a)");
        $arrlength = count($civilstates);
        for($i = 0; $i <$arrlength; $i++) {
          DB::table('civilstates')->insert([
            'statedescription'=>$civilstates[$i],
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}
