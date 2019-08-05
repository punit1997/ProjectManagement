<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
     public function showTeam()
     {
       $team = Auth::user()->team;
       return response()->json(['Team Name' => $team->name, 'Team Lead' => $team->lead->name]);
     }

     public function showProjects()
     {
       $projects = Auth::user()->projects;
       return response()->json(['My Projects' => $projects->map->only(['description'])]);
     }
}
