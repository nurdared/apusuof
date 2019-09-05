<?php
Route::get('/', function () { return redirect('/admin/home'); });

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('auth.login');
Route::post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
Route::get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
Route::patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');


Route::get('invitations/{invitation_id}/{action}', 'AcceptController@accept')->name('invitations.send');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');
    Route::get('/calendar', 'Admin\SystemCalendarController@index'); 
    
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::resource('categories', 'Admin\CategoriesController');
    Route::post('categories_mass_destroy', ['uses' => 'Admin\CategoriesController@massDestroy', 'as' => 'categories.mass_destroy']);
    Route::post('categories_restore/{id}', ['uses' => 'Admin\CategoriesController@restore', 'as' => 'categories.restore']);
    Route::delete('categories_perma_del/{id}', ['uses' => 'Admin\CategoriesController@perma_del', 'as' => 'categories.perma_del']);
    Route::resource('clubs', 'Admin\ClubsController');
    Route::post('clubs_mass_destroy', ['uses' => 'Admin\ClubsController@massDestroy', 'as' => 'clubs.mass_destroy']);
    Route::post('clubs_restore/{id}', ['uses' => 'Admin\ClubsController@restore', 'as' => 'clubs.restore']);
    Route::delete('clubs_perma_del/{id}', ['uses' => 'Admin\ClubsController@perma_del', 'as' => 'clubs.perma_del']);
    Route::resource('threads', 'Admin\ThreadsController');
    Route::post('threads_mass_destroy', ['uses' => 'Admin\ThreadsController@massDestroy', 'as' => 'threads.mass_destroy']);
    Route::post('threads_restore/{id}', ['uses' => 'Admin\ThreadsController@restore', 'as' => 'threads.restore']);
    Route::delete('threads_perma_del/{id}', ['uses' => 'Admin\ThreadsController@perma_del', 'as' => 'threads.perma_del']);
    Route::resource('updates', 'Admin\UpdatesController');
    Route::post('updates_mass_destroy', ['uses' => 'Admin\UpdatesController@massDestroy', 'as' => 'updates.mass_destroy']);
    Route::post('updates_restore/{id}', ['uses' => 'Admin\UpdatesController@restore', 'as' => 'updates.restore']);
    Route::delete('updates_perma_del/{id}', ['uses' => 'Admin\UpdatesController@perma_del', 'as' => 'updates.perma_del']);
    
    
    
    Route::get('invitations/{invitation_id}/send', ['uses' => 'Admin\InvitationsController@send', 'as' => 'invitations.send']);
    Route::get('invitations/import', ['uses' => 'Admin\InvitationsController@import', 'as' => 'invitations.import']);
    Route::post('invitations/import_store', ['uses' => 'Admin\InvitationsController@import_store', 'as' => 'invitations.import_store']);
    
    Route::resource('invitations', 'Admin\InvitationsController');
    Route::post('invitations_mass_destroy', ['uses' => 'Admin\InvitationsController@massDestroy', 'as' => 'invitations.mass_destroy']);
    Route::get('events/{event_id}/send', ['uses' => 'Admin\EventsController@send', 'as' => 'events.send']);
    Route::resource('events', 'Admin\EventsController');
    Route::post('events_mass_destroy', ['uses' => 'Admin\EventsController@massDestroy', 'as' => 'events.mass_destroy']);
    Route::post('events_restore/{id}', ['uses' => 'Admin\EventsController@restore', 'as' => 'events.restore']);
    Route::delete('events_perma_del/{id}', ['uses' => 'Admin\EventsController@perma_del', 'as' => 'events.perma_del']);
    Route::get('volunteers/{volunteer_id}/approve', ['uses' => 'Admin\VolunteersController@approve', 'as' => 'volunteers.approve']);
    Route::get('volunteers/{volunteer_id}/reapprove', ['uses' => 'Admin\VolunteersController@reApprove', 'as' => 'volunteers.reApprove']);
    Route::resource('volunteers', 'Admin\VolunteersController');
    Route::post('volunteers_mass_destroy', ['uses' => 'Admin\VolunteersController@massDestroy', 'as' => 'volunteers.mass_destroy']);
    Route::resource('comments', 'Admin\ClubCommentsController');
    Route::post('comments_mass_destroy', ['uses' => 'Admin\ClubCommentsController@massDestroy', 'as' => 'comments.mass_destroy']);
    Route::resource('threadcomments', 'Admin\ThreadCommentsController');
    Route::post('comments_mass_destroy', ['uses' => 'Admin\ThreadCommentsController@massDestroy', 'as' => 'comments.mass_destroy']);
    Route::resource('eventcomments', 'Admin\EventCommentsController');
    Route::post('comments_mass_destroy', ['uses' => 'Admin\EventCommentsController@massDestroy', 'as' => 'comments.mass_destroy']);

 
});
