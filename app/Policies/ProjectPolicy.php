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
        return $user->team_id == $project->team_id;
    }
}
