<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Project extends Model
{

  protected $fillable = ['description' ,'team_id']; 

  public function team()
  {
    return $this->belongsTo('App\Team');
  }

  public function users()
  {
    return $this->belongsToMany('App\User');
  }

  public function invitations()
  {
    return $this->hasMany('App\Invitation');
  }

  public static function create_project(Request $request)
  {
    $team = Auth::user()->teamLead;
    $request->validate(['description'=> 'required']);
    Project::create(['description'=>$request->description, 'team_id'=>$team->id]);
  }

  public static function show_project()
  {
    $projects = Auth::user()->projects;
    return response()->json(['My Projects' => $projects->map->only(['description'])]);
  }

  public static function show_project_members($projectId)
  {
    $members = Project::find($project_id)->users;
    return response()->json(['Project Member' => $members->map->only(['name','email'])]);
  }

  public static function create_project_member($projectId, $userId)
  {
    DB::table('project_user')->insert(['project_id' => $project->id, 'user_id' => $user->id]);
  }

  public static function remove_project_member($projectId, $userId)
  {

    DB::table('project_user')->where([
      ['project_id','=',$projectId], ['user_id','=',$userId]
      ])->delete();
  }

  public static function destroy(Project $project)
  {
     $project->delete();
  }
}
