<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Civilstate extends Model
{
  protected $fillable = [
    'statedescription'
  ];

  public function user()
  {
    return $this->HasMany('App\User');
  } 
}

?>