<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
  public function create(Request $request)
  {
    $this->authorize('create', Project::class);
    $team = Auth::user()->teamLead;
    $request->validate(['description'=> 'required']);
    Project::create(['description'=>$request->description, 'team_id'=>$team->id]);
  }
 
  public function showProjects()
   {
    $projects = Auth::user()->projects;
    return response()->json(['My Projects' => $projects->map->only(['description'])]);
   }

   public function projectMembers($project_id)
   {
    $project = Project::find($project_id);
    $this->authorize('show', $project);
    $members = Project::find($project_id)->users;
    return response()->json(['Project Member' => $members->map->only(['name','email'])]);
   }


  public function addMemberToProject($projectId, $userId)
  {
    $user = User::find($userId);
    $project = Project::find($projectId);
    $this->authorize('checkProject', $project);
    $this->authorize('checkUser', $user);

    DB::table('project_user')->insert(['project_id' => $project->id, 'user_id' => $user->id]);
  }

  public function removeMemberFromProject($projectId, $userId)
  {
    $user = User::find($userId);
    $project = Project::find($projectId);
    $this->authorize('checkProject', $project);
    $this->authorize('checkUser', $user);

    DB::table('project_user')->where([
      ['project_id','=',$projectId], ['user_id','=',$userId]
      ])->delete();
  }

  public function destroy($projectId)
  {
    $project = Project::find($projectId);
    $this->authorize('checkProject', $project);
    $project->delete();
  }
}
