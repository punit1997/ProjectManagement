<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
  public function create(Request $request)
  {
    $team = Auth::user()->teamLead;
    $request->validate(['description'=> 'required']);
    Project::create(['description'=>$request->description, 'team_id'=>$team->id]);
  }
}
