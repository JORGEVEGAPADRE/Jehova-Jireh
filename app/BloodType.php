<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BloodType extends Model
{
  protected $table = 'bloodtypes';
  protected $fillable = [
    'bloodtype'
  ];

  public function users()
  {
    return $this->hasMany('App\User');
  }
}

?>