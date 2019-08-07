<?php

use Illuminate\Http\Request;

    Route::get('/team', 'TeamController@showTeam')->middleware(['basicauth']);
    Route::get('/projects', 'ProjectController@showProjects')->middleware(['basicauth']);
    Route::get('/team_members', 'TeamController@teamMembers')->middleware(['basicauth']);
    Route::get('/project_members/{project_id}', 'ProjectController@projectMembers')->middleware(['basicauth']);
    Route::post('/project/create', 'ProjectController@create')->middleware(['basicauth']);
    Route::post('/project/{projectId}/{userId}', 'ProjectController@addMemberToProject')->middleware(['basicauth']);
    Route::post('/team/create', 'TeamController@create')->middleware(['basicauth']);
    Route::post('/user/create', 'UserController@create');
    Route::patch('/user/{user_id}', 'UserController@update')->middleware(['basicauth']);
    Route::delete('/project/{projectId}/{userId}', 'ProjectController@removeMemberFromProject')->middleware(['basicauth']);
    Route::delete('/project/{projectId}/', 'ProjectController@destroy')->middleware(['basicauth']);
    Route::post('/invitation/{projectId}/{userId}', 'InvitationController@sendInvitation')->middleware(['basicauth']);    
    Route::patch('/invitation/{invitationId}/accept', 'InvitationController@acceptInvitation')->middleware(['basicauth']); 
    Route::patch('/invitation/{invitationId}/reject', 'InvitationController@rejectInvitation')->middleware(['basicauth']);
    Route::get('/invitations/show', 'InvitationController@showMyInvitations')->middleware(['basicauth']);
