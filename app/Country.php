<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
  // 'name_bank', 'user_id',
  protected $fillable = [
    'country'
  ];

  public function users()
  {
    return $this->hasMany('App\User');
  } 
}

?>