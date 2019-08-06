<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
  public function create(Request $request)
  {
    $team = Auth::user()->teamLead;
    $request->validate(['description'=> 'required']);
    Project::create(['description'=>$request->description, 'team_id'=>$team->id]);
  }

  public function addMemberToProject($projectId, $userId)
  {
    $team = Auth::user()->teamLead;
    $user = $team->users->find($userId);
    $project = $team->projects->find($projectId);

    if($user==NULL || $project==NULL)
    {
      return "Invalid project/user ID";
    }

    DB::table('project_user')->insert(['project_id' => $project->id, 'user_id' => $user->id]);
  }
}
