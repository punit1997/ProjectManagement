<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Invitation;
use App\User;
use App\Project;
use Illuminate\Http\Request;
use App\Mail\SendInvitation;
use Illuminate\Support\Facades\DB;

class InvitationController extends Controller
{
  public function sendInvitation($projectId, $userId)
  {
    $project = Project::find($projectId);
    $this->authorize('checkProject', $project);
    Invitation::send_invitation($project, $userId);
  }

  public function acceptInvitation($invitationId)
  {
    $invitation = Invitation::find($invitationId);
    $this->authorize('checkInvitation', $invitation);
    Invitation::send_invitation($invitation);
  }

  public function rejectInvitation($invitationId)
  {
    $invitation = Invitation::find($invitationId);
    $this->authorize('checkInvitation', $invitation);
    Invitation::reject_invitation($invitation);
   
  }

  public function showMyInvitations()
  {
    return Invitation::show_my_invitation();
  }
}
