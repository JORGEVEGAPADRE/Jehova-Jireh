<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bankAccount extends Model
{
  protected $table = 'bankaccounts';
  protected $fillable = [
    'bank_id','accountnumber','openamount','created_at','update_at'
  ];  
  public function Bank()
    {
      return $this->belongsTo('App\Bank');
    } 
}
