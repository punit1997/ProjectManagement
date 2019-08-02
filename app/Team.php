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

  public function teamLead()
  {
    return $this->belongsTo('App\User', 'lead_id');
  }
}
