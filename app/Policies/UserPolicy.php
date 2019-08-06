<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return $user->role == "admin";
    }

    public function update(User $user)
    {
        return $user->role == "admin";
    }

}
