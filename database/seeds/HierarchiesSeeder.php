<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class HierarchiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      for ($i=1; $i < 101; $i++) {            
        DB::table('hierarchies')->insert(['hierarchy' =>$i]);
      }    
    }
}
