<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
  public function users()
  {
    return $this->hasMany('App\User');
  }

  public function projects()
  {
    return $this->hasMany('App\Project');
  }

  public function lead()
    {
      return $this->hasOne('App\User', 'lead_id');
    }

}
