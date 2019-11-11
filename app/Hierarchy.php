<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hierarchy extends Model
{
  //protected $table = 'jobstates';
  protected $fillable = [
    'hierarchy'
  ];

  public function user()
  {
    return $this->HasMany('App\User');
  }
}

?>