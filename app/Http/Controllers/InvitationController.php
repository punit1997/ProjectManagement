<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Invitation;
use App\User;
use App\Project;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
  public function sendInvitation($projectId, $userId)
  {
    $project = Project::find($projectId);
    $this->authorize('checkProject', $project);
    $team = Auth::user()->teamLead;
    $user = User::find($userId);
    Invitation::create(['team_id' => $team->id, 'user_id' => $user->id, 'project_id' => $project->id]);
  }
}
