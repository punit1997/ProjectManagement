<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Invitation extends Model
{
     protected $fillable = [
        'team_id', 'user_id', 'project_id',
      ];
  
     public function user()
     {
      return $this->belongsTo('App\User');
     }
     
     public function team()
     {
      return $this->belongsTo('App\Team');
     }
    
     public function project()
     {
      return $this->belongsTo('App\Project');
     }

     public static send_invitation(Project $project, $userId)
     {
      $team = Auth::user()->teamLead;
      $user = User::find($userId);
      Invitation::create(['team_id' => $team->id, 'user_id' => $user->id, 'project_id' => $project->id]);

      \Mail::to($user)->send(new SendInvitation($project));
     }

     public static accept_invitation(Invitation $invitation)
     {
      $invitation->status = "Accepted";
      $invitation->save();
      DB::table('project_user')->insert(['project_id' => $invitation->project_id, 'user_id' => Auth::user()->id]);
     }

     public static function reject_invitation(Invitation $invitation)
     {
      $invitation->status = "rejected";
      $invitation->save();
     }

     public static function show_my_invitation()
     {
      $user = Auth::user();
      return response()->json(['My Invitations' => $user->invitations]);
     }

}
