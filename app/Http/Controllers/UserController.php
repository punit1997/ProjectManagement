<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
     public function showTeam($user_id)
     {
       $team = Auth::user()->team;

       return response()->json(['Team Name' => $team->name, 'Team Lead' => $team->lead->name]);
     }
}
