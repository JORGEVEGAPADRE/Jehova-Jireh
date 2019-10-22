<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
  // 'name_bank', 'user_id',
  protected $fillable = [
    'namebank'
  ];

  public function bankAccount()
  {
    return $this->hasMany('App\bankAccount');
  } 
}

?>