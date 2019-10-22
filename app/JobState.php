<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobState extends Model
{
  protected $table = 'jobstates';
  protected $fillable = [
    'jobdescription', 
  ];

  public function user()
  {
    return $this->HasMany('App\User');
  }
}

?>