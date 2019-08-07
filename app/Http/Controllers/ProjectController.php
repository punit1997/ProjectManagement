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
    Project::create_project($request);
  }

  public function showProjects()
  {
    return Project::show_project();
  }

   public function projectMembers($project_id)
   {
    $project = Project::find($project_id);
    $this->authorize('show', $project);

    return Project::show_project_members($projectId);
   }


  public function addMemberToProject($projectId, $userId)
  {
    $user = User::find($userId);
    $project = Project::find($projectId);
    $this->authorize('checkProject', $project);
    $this->authorize('checkUser', $user);
    
    Project::create_project_member($projectId, $userId);
   }

  public function removeMemberFromProject($projectId, $userId)
  {
    $user = User::find($userId);
    $project = Project::find($projectId);
    $this->authorize('checkProject', $project);
    $this->authorize('checkUser', $user);

    Project::remove_project_member($projectId, $userId);
    }

  public function destroy($projectId)
  {
    $project = Project::find($projectId);
    $this->authorize('checkProject', $project);

    Project::destroy($project);
  }
}
