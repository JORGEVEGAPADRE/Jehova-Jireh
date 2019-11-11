<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
class JobstatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {               
        $jobstates=array("Sin Trabajo","Con Trabajo","Empleador","Trabajo Independiente","Oficios del Hogar","Discapacitado con Ingresos","Discapacitado Sin Ingresos","Jubilado con Pension","Jubilado sin Pension");
        $arrlength = count($jobstates);
        for($i = 0; $i <$arrlength; $i++) {
          DB::table('jobstates')->insert([
            'jobdescription'=>$jobstates[$i],
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
          
        }
    }
}
