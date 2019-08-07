<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Team extends Model
{
  protected $fillable = ['name'];

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

  public function invitations()
  {
    return $this->hasMany('App\Invitation');
  }

  public static function create_team(Request $request)
  {
    $request->validate(['name'=> 'required', 'lead_id'=> 'required']);
    $users = User::all();
    $lead  = $users->find($request->lead_id);

    if($lead == NULL)
      {
        return("Invalid lead id");
      }

    $team = Team::create(['name'=>$request->name]);
    $lead->lead_id = $team->id;
    $lead->save();
  }

  public static function show_team()
  {
    $team = Auth::user()->team;
    return response()->json(['Team Name' => $team->name, 'Team Lead' => $team->lead->name]);
  }

  public static function team_members()
  {
    $team = Auth::user()->team_id;
    $members = Team::find($team)->users;
    return response()->json(['Team Member' => $members->map->only(['name','email'])]);
  }

}
