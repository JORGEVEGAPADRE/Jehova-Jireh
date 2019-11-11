<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ministry extends Model
{
  protected $table = 'ministries';
  protected $fillable = [
    'ministry', 
  ];

  public function user()
  {
    return $this->HasMany('App\User');
  }
}

?>