<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  use Notifiable;

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
  protected $fillable = [
    'name','lastname','role','country_id','sex_id','bloodtype_id','civilstate_id','jobstate_id','birthdate','rut',
    'occupation','newbirthdate','baptizeddate','lifetestimony','email','alternateemail',
    'phone','address','notes','password','confirmpassword','hierarchy_id' 
       
  ];

  
  /**
  * The attributes that should be hidden for arrays.
  *
  * @var array
  */
  protected $hidden = [
    'password', 'remember_token',
  ];

 
 /* public function banks()
  {
    return $this->hasMany('App\Bank');

  } */
  public function genders()
  {
    return $this->belongsTo('App\Gender');
  } 
  public function countries()
  {
    return $this->belongsTo('App\Country');
  } 

  public function bloodtypes()
  {
    return $this->belongsTo('App\BloodType');
  }

  public function civilstates()
  {
    return $this->belongsTo('App\CivilState');
  } 

  public function jobstates()
  {
    return $this->belongsTo('App\JobState');
  } 

  public function churchjobs()
  {
    return $this->belongsTo('App\ChurchJob');
  } 

  public function hierarchies()
  {
    return $this->hasMany('App\Hierarchy');
  } 
 
  
 
} 
