<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
  
  protected $fillable = [
    'sex'
  ];
    
  public function users()
  {
    return $this->hasMany('App\User');
  }


}

?>