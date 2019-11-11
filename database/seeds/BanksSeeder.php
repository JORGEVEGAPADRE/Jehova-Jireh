<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class BanksSeeder extends Seeder
{
    public function run()
    {               
        $banks=array(
            "BancoEstado (Banco del Estado de Chile)",
            "Banco de Chile",
            "Banco Edwards (Banco de Chile)", 
            "Citi y CrediChile (Banco de Chile)", 
            "Banco Internacional",
            "Scotiabank",
            "Banco del Desarrollo (Scotiabank Chile)",
            "BCI (Banco de Crédito e Inversiones)",
            "Banco Nova (Banco de Crédito e Inversiones)",
            "Banco Bice",
            "HSBC Bank (Chile)",
            "Banco Santander-Chile",
            "Banefe (Banco Santander-Chile)",
            "Itaú Corpbanca",
            "BanCondell (Itaú Corpbanca)",
            "Banco Security",
            "Banco Falabella",
            "Banco Ripley",
            "Banco Consorcio",
            "Banco BTG Pactual Chile",
            "Banco Bilbao Vizcaya Argentaria, Chile (BBVA)",
            "BBVA Express (Banco Bilbao Vizcaya Argentaria, Chile BBVA )",
            "BBVA (Banco Bilbao Vizcaya Argentaria, Chile BBVA)",
            "Banco do Brasil S.A.",
            "JP Morgan Chase Bank, N. A.",
            "Banco de la Nación Argentina",
            "The Bank of Tokyo-Mitsubishi, LTD.",
            "China Construction Bank, Agencia en Chile"
        );        
        $arrlength = count($banks);
        for($i = 0; $i <$arrlength; $i++) {
          DB::table('banks')->insert([
              'namebank'=>$banks[$i],
              'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
              'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
              ]);
        }
    }

}