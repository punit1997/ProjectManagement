<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Team;

class TeamController extends Controller
{
   public function create(Request $request)
   { 
     $this->authorize('create', Team::class);
     Team::create_team($request);
   }

   public function showTeam()
   {
     return Team::show_team();
   }

   public function teamMembers()
   {
     return Team::team_members();
   }
}
