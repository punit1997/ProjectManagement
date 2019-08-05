<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Team;
use App\Project;
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

     public function teamMembers()
     {
       $team = Auth::user()->team_id;
       $members = Team::find($team)->users;
       return response()->json(['Team Member' => $members->map->only(['name','email'])]);
     }

     public function projectMembers($project_id)
     {
       $members = Project::find($project_id)->users;
       return response()->json(['Project Member' => $members->map->only(['name','email'])]);
     }

}
