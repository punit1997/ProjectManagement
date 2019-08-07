<?php

namespace App\Policies;

use App\User;
use App\Project;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;
    public function show(User $user, Project $project)
    {
      return $project->users->contains($user);
    }

    public function create(User $user)
    {
        return $user->role == "Team Lead";
    }

    public function checkProject(User $user, Project $project)
    {
        return $user->role == "Team Lead" && $project->team_id == $user->team_id;
    }
}
