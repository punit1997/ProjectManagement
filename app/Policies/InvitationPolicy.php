<?php

namespace App\Policies;

use App\User;
use App\Invitation;
use Illuminate\Auth\Access\HandlesAuthorization;

class InvitationPolicy
{
    use HandlesAuthorization;

    public function checkRole(User $user)
    {
       return $user->role == "Team Lead";
    }

    public function checkInvitation(User $user, Invitation $invitation)
    {
       return $user->id == $invitation->user_id;
    }

}
