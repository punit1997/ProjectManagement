<?php

use Illuminate\Http\Request;
Route::middleware(['basicauth'])->group(function () {
    Route::get('/team', 'TeamController@showTeam');
    Route::get('/projects', 'ProjectController@showProjects');
    Route::get('/team_members', 'TeamController@teamMembers');
    Route::get('/project_members/{project_id}', 'ProjectController@projectMembers');
    Route::post('/project/create', 'ProjectController@create');
    Route::post('/project/{projectId}/{userId}', 'ProjectController@addMemberToProject');
    Route::post('/team/create', 'TeamController@create');
    Route::post('/user/create', 'UserController@create');
    Route::patch('/user/{user_id}', 'UserController@update');
    Route::delete('/project/{projectId}/{userId}', 'ProjectController@removeMemberFromProject');
    Route::delete('/project/{projectId}/', 'ProjectController@destroy');
    Route::post('/invitation/{projectId}/{userId}', 'InvitationController@sendInvitation');
    Route::patch('/invitation/{invitationId}/accept', 'InvitationController@acceptInvitation');
    Route::patch('/invitation/{invitationId}/reject', 'InvitationController@rejectInvitation');
    Route::get('/invitations/show', 'InvitationController@showMyInvitations');
});
