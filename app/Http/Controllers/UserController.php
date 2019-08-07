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
       $request->validate(['name'=>'required', 'email'=>'required', 'role'=>'required', 'team_id'=>'required']);
       $user = new User;
       $team = Team::find($request->team_id);

       if($team == NULL)
       {
         return ("Invalid Team");
       }

       $user->name = $request->name;
       $user->email = $request->email;
       $user->role = $request->role;
       $user->team_id = $request->team_id;
       $user->password = Hash::make($request->password);
       $user->save();
     }

      public function update(Request $request, $user_id)
      {
         $this->authorize('update', User::class);
         $user = User::find($user_id);

         if($request->has('name'))
         {
           $user->name = $request->name;
         }

         if($request->has('email'))
         {
          $user->email = $request->email;
         }

         if($request->has('role'))
         {
          $user->role = $request->role;
         }

         if($request->has('password'))
         {
          $user->password = $request->password;
         }

         $user->save();
     }

}
