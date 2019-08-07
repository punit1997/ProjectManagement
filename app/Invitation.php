<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
     protected $fillable = [
        'team_id', 'user_id', 'project_id',
      ];
  
     public function user()
     {
      return $this->belongsTo('App\User');
     }
     
     public function team()
     {
      return $this->belongsTo('App\Team');
     }
    
     public function project()
     {
      return $this->belongsTo('App\Project');
     }

}
