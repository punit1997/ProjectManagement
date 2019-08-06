<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Team;

class TeamController extends Controller
{
   public function create(Request $request)
   {
      $this->authorize('create', Team::class);
      $request->validate(['name'=> 'required', 'lead_id'=> 'required']);
      $users = User::all();
      $lead  = $users->find($request->lead_id);

      if($lead == NULL)
      {
        return("Invalid lead id");
      }

      $team = Team::create(['name'=>$request->name]);
      $lead->lead_id = $team->id;
      $lead->save();
   }
}
