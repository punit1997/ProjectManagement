<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
      ];

    public function team()
    {
      return $this->belongsTo('App\Team');
    }

    public function teamLead()
   {
      return $this->belongsTo('App\Team', 'lead_id');
   }

    public function projects()
    {
        return $this->belongsToMany('App\Project');
    }

    public function invitations()
   {
    return $this->hasMany('App\Invitation');
   }

    public static function create_user(Request $request)
    {
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

    public static function update_user(Request $request, $user_id)
    {
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
