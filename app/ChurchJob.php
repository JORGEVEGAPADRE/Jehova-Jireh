<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChurchJob extends Model
{
  protected $table = 'churchjobs';
  protected $fillable = [
    'churchjob','level'
  ];
  
  public function users()
  {
    return $this->hasMany('App\User');
  }


}

?>