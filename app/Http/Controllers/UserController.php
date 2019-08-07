<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Team;
use App\Project;
use App\User;

class UserController extends Controller
{
     public function create(Request $request)
     {
       $this->authorize('create', User::class);
       User::create_user($request);
     }

      public function update(Request $request, $user_id)
      {
        $this->authorize('update', User::class);
        User::update_user($request, $user_id);
      }

}
