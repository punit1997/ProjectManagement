<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware(['basicauth'])->group(function () {
    Route::get('/user/team', 'UserController@showTeam')->middleware(['basicauth']);
    Route::get('/user/projects', 'UserController@showProjects')->middleware(['basicauth']);
    Route::get('/user/team_members', 'UserController@teamMembers')->middleware(['basicauth']);
    Route::get('/user/project_members/{project_id}', 'UserController@projectMembers')->middleware(['basicauth']);
    Route::post('/project/create', 'ProjectController@create')->middleware(['basicauth']);
    Route::post('/project/{projectId}/{userId}', 'ProjectController@addMemberToProject')->middleware(['basicauth']);
    Route::post('/team/create', 'TeamController@create')->middleware(['basicauth']);
    Route::post('/user/create', 'UserController@create')->middleware(['basicauth']); 
    Route::patch('/user/{user_id}', 'UserController@update')->middleware(['basicauth']);
    Route::delete('/project/{projectId}/{userId}', 'ProjectController@removeMemberFromProject')->middleware(['basicauth']);
    Route::delete('/project/{projectId}/', 'ProjectController@destroy')->middleware(['basicauth']);
    Route::post('/invitation/{projectId}/{userId}', 'InvitationController@sendInvitation')->middleware(['basicauth']);    
    Route::patch('/invitation/{invitationId}/accept', 'InvitationController@acceptInvitation')->middleware(['basicauth']); 
    Route::patch('/invitation/{invitationId}/reject', 'InvitationController@rejectInvitation')->middleware(['basicauth']);
    Route::get('/invitations/show', 'InvitationController@showMyInvitations')->middleware(['basicauth']);
 
});
